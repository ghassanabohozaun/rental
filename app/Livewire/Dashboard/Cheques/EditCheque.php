<?php

namespace App\Livewire\Dashboard\Cheques;

use App\Models\Cheque;
use App\Models\Company;
use App\Models\Contract;
use App\Services\Dashboard\ChequeService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class EditCheque extends Component
{
    public Cheque $cheque;

    public $contract_id;
    public $customer_id;
    public $company_id;
    public $cheque_number;
    public $amount;
    public $status;
    public $is_deposit;
    public $issue_date;
    public $due_date;
    public $bank_name = ['ar' => '', 'en' => ''];
    public $cheque_owner_name = ['ar' => '', 'en' => ''];
    public $notes;

    public $validation_fail_nonce = 0;

    public $financials = [];
    public $projectedRemaining = 0;
    public $isContractFulfilled = false;
    public $currentChequeUsedAmount = 0;
    public $dateWarning = '';

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Cheque $cheque)
    {
        $this->cheque = $cheque;
        
        $this->contract_id = $cheque->contract_id;
        $this->customer_id = $cheque->customer_id;
        $this->company_id = $cheque->company_id;
        $this->cheque_number = $cheque->cheque_number;
        $this->amount = $cheque->amount;
        $this->status = $cheque->status;
        $this->is_deposit = $cheque->is_deposit;
        $this->issue_date = $cheque->issue_date ? $cheque->issue_date->format('Y-m-d') : null;
        $this->due_date = $cheque->due_date ? $cheque->due_date->format('Y-m-d') : null;
        $this->bank_name = [
            'ar' => $cheque->getTranslation('bank_name', 'ar'),
            'en' => $cheque->getTranslation('bank_name', 'en'),
        ];
        $this->cheque_owner_name = [
            'ar' => $cheque->getTranslation('cheque_owner_name', 'ar'),
            'en' => $cheque->getTranslation('cheque_owner_name', 'en'),
        ];
        $this->notes = $cheque->notes;
        $this->currentChequeUsedAmount = $cheque->used_amount;

        $this->calculateFinancials();
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

        // Sum of all other pending cheques (excluding current)
        $otherPendingCheques = $allCheques->where('status', 'pending')->where('id', '!=', $this->cheque->id);
        $totalOtherUnused = $otherPendingCheques->sum('remaining_amount');

        // Current cheque unused portion
        $currentChequeUnused = max(0, (float)$this->amount - $this->currentChequeUsedAmount);

        if ($this->is_deposit == 1) {
            // For insurance cheques, we check against deposit amount
            $this->projectedRemaining = $contract->deposit_amount - $totalOtherUnused - $currentChequeUnused;
        } else {
            $this->projectedRemaining = $contractRemaining - $totalOtherUnused - $currentChequeUnused;
        }

        // We don't need to check if contract is fully covered in edit mode to block saving,
        // but we can set it for UI purposes if needed.
        $this->isContractFulfilled = false;
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

    public function update()
    {
        Gate::authorize('cheques_update');

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

        // Ensure amount is not less than used amount
        if ($this->currentChequeUsedAmount > 0 && (float)$this->amount < $this->currentChequeUsedAmount) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_cannot_be_less_than_used') . ' (' . number_format($this->currentChequeUsedAmount, 2) . ')'
            ]);
        }

        // Complex Balance Validation
        $this->validateBalance($validatedData['amount']);

        $service = app(ChequeService::class);

        try {
            $service->update($this->cheque->id, $validatedData);
            session()->flash('success', __('general.update_success_message'));
            return redirect()->route('dashboard.cheques.index');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Livewire Update Error: ' . $e->getMessage());
            $this->addError('general', $e->getMessage());
        }
    }

    protected function validateBalance($amount)
    {
        if ($this->is_deposit == 1) return;

        $contract = Contract::with('cheques')->find($this->contract_id);
        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;

        $otherCheques = $contract->cheques->where('status', 'pending')->where('id', '!=', $this->cheque->id);

        $otherPendingTotal = $otherCheques->sum('remaining_amount');
        $availableToCover = max(0, $totalAmount - $paidAmount - $otherPendingTotal);

        if ($amount > $availableToCover + $this->currentChequeUsedAmount + 0.01) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_exceeds_contract_remaining') . ' (' . number_format($availableToCover + $this->currentChequeUsedAmount, 2) . ')'
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

        return view('livewire.dashboard.cheques.edit-cheque', [
            'companies' => $companies,
            'contracts' => $contracts,
        ]);
    }
}
