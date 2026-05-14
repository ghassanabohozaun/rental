<?php

namespace App\Livewire\Dashboard\Cheques;

use App\Models\Company;
use App\Models\Contract;
use App\Services\Dashboard\ChequeService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class CreateCheque extends Component
{
    public $contract_id;
    public $customer_id;
    public $company_id;
    public $cheque_number;
    public $amount;
    public $status = 'pending';
    public $is_deposit = 0;
    public $issue_date;
    public $due_date;
    public $bank_name = ['ar' => '', 'en' => ''];
    public $cheque_owner_name = ['ar' => '', 'en' => ''];
    public $notes;

    public $validation_fail_nonce = 0;

    public $financials = [];
    public $projectedRemaining = 0;
    public $isContractFulfilled = false;
    public $dateWarning = '';

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($is_deposit = 0, $contract_id = null, $company_id = null)
    {
        $this->is_deposit = $is_deposit;
        $this->resetFinancials(); // Ensure defaults are set

        // Defensive check for params
        if ($company_id) {
            $this->company_id = $company_id;
        }
        if ($contract_id) {
            // Verify contract exists and matches company if provided
            $query = Contract::where('id', $contract_id);
            if ($this->company_id) {
                $query->where('company_id', $this->company_id);
            }
            if ($query->exists()) {
                $this->contract_id = $contract_id;
            }
        }

        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }

        // Final calculation safety
        if ($this->contract_id) {
            $this->calculateFinancials();
        }

        // Default status for insurance cheques
        if ($this->is_deposit == 1) {
            $this->status = 'held';
        }
    }

    public function updatedContractId()
    {
        $this->calculateFinancials();
        $this->dispatch('reinit-plugins');
    }

    public function updatedCompanyId()
    {
        $this->contract_id = null;
        $this->resetFinancials();
        $this->dispatch('reinit-plugins');
    }

    public function updatedAmount()
    {
        $this->calculateFinancials();
    }

    public function updatedIssueDate($value)
    {
        $this->checkDates();
    }

    public function updatedDueDate($value)
    {
        $this->checkDates();
    }

    public function checkDates()
    {
        $this->dateWarning = '';
        if ($this->issue_date && $this->due_date) {
            if (strtotime($this->due_date) < strtotime($this->issue_date)) {
                $this->dateWarning = __('cheques.due_date_before_issue_date');
            }
        }
    }

    public function calculateFinancials()
    {
        if (!$this->contract_id) {
            $this->resetFinancials();
            return;
        }

        $contract = Contract::with(['cheques', 'customer', 'property'])->find($this->contract_id);
        
        if (!$contract) {
            $this->resetFinancials();
            $this->contract_id = null;
            return;
        }

        $this->customer_id = $contract->customer_id;

        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;
        $remaining = $contract->remaining_amount;

        // Financial Health Calculations
        $allCheques = $contract->cheques;
        $pendingOriginal = $allCheques->where('status', 'pending')->sum('amount');
        $pendingTotal = $allCheques->where('status', 'pending')->sum('remaining_amount');

        $this->financials = [
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining' => $remaining,
            'pending_total' => $pendingTotal,
            'pending_original' => $pendingOriginal,
            'deposit_amount' => $contract->deposit_amount,
        ];

        // Projected Remaining
        $contractRemaining = $remaining;

        // Sum of all other pending cheques
        $totalOtherUnused = $allCheques->where('status', 'pending')->sum('remaining_amount');

        // Current cheque unused portion (for create, it's the full amount)
        $currentChequeUnused = max(0, (float)$this->amount);

        if ($this->is_deposit == 1) {
            // For insurance cheques, we check against deposit amount
            $this->projectedRemaining = $contract->deposit_amount - $totalOtherUnused - $currentChequeUnused;
        } else {
            $this->projectedRemaining = $contractRemaining - $totalOtherUnused - $currentChequeUnused;
        }

        // Check if contract is already fully covered by cheques (only for non-deposit)
        if ($this->is_deposit == 0 && $this->projectedRemaining + $currentChequeUnused <= 0) {
            $this->isContractFulfilled = true;
        } else {
            $this->isContractFulfilled = false;
        }
    }

    public function resetFinancials()
    {
        $this->financials = [
            'total_amount' => 0,
            'paid_amount' => 0,
            'remaining' => 0,
            'pending_total' => 0,
            'pending_original' => 0,
            'deposit_amount' => 0,
        ];
        $this->projectedRemaining = 0;
        $this->isContractFulfilled = false;
    }

    public function store()
    {
        Gate::authorize('cheques_create');

        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|gt:0',
            'cheque_number' => 'required|string|max:255',
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'cheque_owner_name.ar' => 'required|string|max:255',
            'cheque_owner_name.en' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:pending,paid,cancelled,returned',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        try {
            $validatedData = $this->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->validation_fail_nonce++;
            $this->dispatch('reinit-plugins');
            throw $e;
        }

        $validatedData['is_deposit'] = $this->is_deposit;

        // Convert empty strings to null for nullable dates
        $validatedData['due_date'] = $validatedData['due_date'] ?: null;
        $validatedData['issue_date'] = $validatedData['issue_date'] ?: null;

        // Complex Balance Validation
        $this->validateBalance($validatedData['amount']);

        $service = app(ChequeService::class);

        try {
            $service->store($validatedData);
            session()->flash('success', __('general.add_success_message'));
            return redirect()->route('dashboard.cheques.index');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Livewire Store Error: ' . $e->getMessage());
            $this->addError('general', $e->getMessage());
        }
    }

    protected function validateBalance($amount)
    {
        if ($this->is_deposit == 1) return;

        $contract = Contract::with('cheques')->find($this->contract_id);
        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;

        $otherPendingTotal = $contract->cheques->where('status', 'pending')->sum('remaining_amount');
        $availableToCover = max(0, $totalAmount - $paidAmount - $otherPendingTotal);

        if ($amount > $availableToCover + 0.01) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_exceeds_contract_remaining') . ' (' . number_format($availableToCover, 2) . ')'
            ]);
        }
    }

    public function render()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        $contracts = collect();
        if ($this->company_id) {
            $contracts = Contract::where('company_id', $this->company_id)
                ->with('customer', 'property')
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('livewire.dashboard.cheques.create-cheque', [
            'companies' => $companies,
            'contracts' => $contracts,
        ]);
    }
}
