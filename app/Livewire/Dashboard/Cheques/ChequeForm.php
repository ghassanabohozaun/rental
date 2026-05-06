<?php

namespace App\Livewire\Dashboard\Cheques;

use Livewire\Component;
use App\Models\Contract;
use App\Models\Cheque;
use App\Models\Company;
use App\Services\Dashboard\ChequeService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Support\Facades\Gate;

class ChequeForm extends Component
{
    // Form State
    public $isEdit = false;
    public $chequeId = null;
    public $company_id;
    public $contract_id;
    public $customer_id;
    public $amount;
    public $cheque_number;
    public $status = 'pending';
    public $is_deposit = 0;
    public $issue_date;
    public $due_date;
    public $bank_name = ['ar' => '', 'en' => ''];
    public $cheque_owner_name = ['ar' => '', 'en' => ''];
    public $notes;

    // UI Data
    public $companies = [];
    public $contracts = [];
    public $financials = [
        'total_amount' => 0,
        'paid_amount' => 0,
        'remaining' => 0,
        'pending_total' => 0,
        'pending_original' => 0,
        'deposit_amount' => 0,
    ];
    public $projectedRemaining = 0;
    public $isContractFulfilled = false;
    public $currentChequeUsedAmount = 0;
    public $dateWarning = null;

    public function mount($chequeId = null, $is_deposit = 0)
    {
        $this->chequeId = $chequeId;
        $this->is_deposit = $is_deposit;

        if (user()->company_id == 1) {
            $this->companies = Company::active()->get();
        } else {
            $this->company_id = user()->company_id;
        }

        if ($this->chequeId) {
            $this->isEdit = true;
            $this->loadCheque();
        } else {
            // Only load contracts if company_id is already set (for regular users)
            if ($this->company_id) {
                $this->loadContracts();
            }
            $this->issue_date = now()->format('Y-m-d');
        }
    }

    public function loadCheque()
    {
        $cheque = Cheque::findOrFail($this->chequeId);
        $this->company_id = $cheque->company_id;
        $this->contract_id = $cheque->contract_id;
        $this->customer_id = $cheque->customer_id;
        $this->amount = $cheque->amount;
        $this->cheque_number = $cheque->cheque_number;
        $this->status = $cheque->status;
        $this->is_deposit = $cheque->is_deposit;
        $this->issue_date = $cheque->issue_date ? $cheque->issue_date->format('Y-m-d') : '';
        $this->due_date = $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '';
        $this->bank_name = $cheque->getTranslations('bank_name');
        $this->cheque_owner_name = $cheque->getTranslations('cheque_owner_name');
        $this->notes = $cheque->notes;
        $this->currentChequeUsedAmount = (float) $cheque->used_amount;

        $this->loadContracts();
        $this->loadFinancials();
    }

    public function loadContracts()
    {
        // If superuser hasn't selected a company yet, don't load any contracts
        if (user()->company_id == 1 && !$this->company_id) {
            $this->contracts = [];
            return;
        }

        $query = Contract::with(['customer', 'property'])->where('status', 'active')->orderByDesc('id');

        if ($this->company_id) {
            $query->where('company_id', $this->company_id);
        } elseif (user()->company_id != 1) {
            $query->where('company_id', user()->company_id);
        }

        $this->contracts = $query->get();
    }

    public function updatedCompanyId($value)
    {
        $this->company_id = $value;
        $this->contract_id = null;
        $this->loadContracts();
        $this->resetFinancials();
        $this->dispatch('reinit-plugins');
    }

    public function updatedContractId()
    {
        $this->loadFinancials();

        // Auto-fill customer ID
        $contract = Contract::find($this->contract_id);
        if ($contract) {
            $this->customer_id = $contract->customer_id;
            if ($this->is_deposit == 1 && !$this->isEdit) {
                $this->amount = $contract->deposit_amount;
            }
        }

        $this->calculateProjected();
        $this->checkDateWarning();
    }

    public function updatedIssueDate() { $this->checkDateWarning(); }
    public function updatedDueDate() { $this->checkDateWarning(); }

    public function checkDateWarning()
    {
        $this->dateWarning = null;
        if (!$this->due_date) return;

        try {
            $due = \Carbon\Carbon::parse($this->due_date);
            $now = now();

            if ($due->isPast() && $due->diffInMonths($now) > 6) {
                $this->dateWarning = __('cheques.stale_cheque_warning');
            } elseif ($due->diffInYears($now) > 1) {
                $this->dateWarning = __('cheques.far_future_cheque_warning');
            }
        } catch (\Exception $e) {}
    }


    public function updatedAmount()
    {
        $this->calculateProjected();
    }

    public function loadFinancials()
    {
        if (!$this->contract_id) {
            $this->resetFinancials();
            return;
        }

        $contract = Contract::with(['payments', 'cheques'])->find($this->contract_id);
        if ($contract) {
            $this->financials = [
                'total_amount' => $contract->total_amount,
                'paid_amount' => $contract->paid_amount,
                'remaining' => $contract->remaining_amount,
                'pending_total' => $contract->cheques()->where('is_deposit', false)->get()->sum('remaining_amount'),
                'pending_original' => $contract->cheques()->where('is_deposit', false)->sum('amount'),
                'deposit_amount' => $contract->deposit_amount,
            ];
            $this->calculateProjected();
            $this->checkIfFulfilled();
        }
    }

    public function checkIfFulfilled()
    {
        if (!$this->contract_id || $this->isEdit) {
            $this->isContractFulfilled = false;
            return;
        }

        $contract = Contract::find($this->contract_id);
        if (!$contract) return;

        if ($this->is_deposit == 1) {
            // For deposit, we check if there's already a deposit cheque
            $this->isContractFulfilled = Cheque::where('contract_id', $this->contract_id)->where('is_deposit', true)->exists();
            return;
        }

        // For regular cheques: Check if remaining balance after payments AND other cheques is 0
        $contractRemaining = $contract->remaining_amount;
        $totalOtherUnused = Cheque::where('contract_id', $this->contract_id)
            ->where('is_deposit', false)
            ->get()
            ->sum('remaining_amount');

        $this->isContractFulfilled = round($contractRemaining - $totalOtherUnused, 2) <= 0;
    }

    public function calculateProjected()
    {
        if (!$this->contract_id) {
            $this->projectedRemaining = 0;
            return;
        }

        $amt = (float) $this->amount;

        if ($this->is_deposit == 1) {
            // For deposits, we usually have one cheque covering the amount
            $otherDeposits = Cheque::where('contract_id', $this->contract_id)
                ->where('is_deposit', true);
            if ($this->isEdit) {
                $otherDeposits->where('id', '!=', $this->chequeId);
            }
            $existingDepositTotal = $otherDeposits->sum('amount');
            $this->projectedRemaining = $this->financials['deposit_amount'] - $existingDepositTotal - $amt;
            return;
        }

        // For regular rent:
        // Contract Remaining (already accounts for PAID payments)
        $contractRemaining = $this->financials['remaining'];

        // Sum of all OTHER pending/unused cheques
        $otherChequesQuery = Cheque::where('contract_id', $this->contract_id)
            ->where('is_deposit', false);

        if ($this->isEdit) {
            $otherChequesQuery->where('id', '!=', $this->chequeId);
        }

        $totalOtherUnused = $otherChequesQuery->get()->sum('remaining_amount');

        // The "Coverage" this cheque provides is its new amount minus what's already paid from it
        $currentChequeUnused = max(0, $amt - $this->currentChequeUsedAmount);

        // Projected = Remaining - Other Cheques - This Cheque Unused
        $this->projectedRemaining = $contractRemaining - $totalOtherUnused - $currentChequeUnused;
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

    public function save()
    {
        $this->isEdit ? Gate::authorize('cheques_update') : Gate::authorize('cheques_create');

        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|gt:0',
            'cheque_number' => 'required|string|max:255',
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'cheque_owner_name.ar' => 'required|string|max:255',
            'cheque_owner_name.en' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|in:pending,cleared,bounced,held',
            'notes' => 'nullable|string',
        ];

        // Unique Cheque Number check
        $uniqueCheck = Cheque::where('cheque_number', $this->cheque_number)
            ->where('bank_name->ar', $this->bank_name['ar'])
            ->where('company_id', user()->company_id == 1 ? $this->company_id : user()->company_id);

        if ($this->isEdit) {
            $uniqueCheck->where('id', '!=', $this->chequeId);
        }

        if ($uniqueCheck->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'cheque_number' => __('cheques.duplicate_cheque_number')
            ]);
        }

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validatedData = $this->validate($rules);
        $validatedData['is_deposit'] = $this->is_deposit;

        // Convert empty strings to null for nullable dates
        $validatedData['due_date'] = $validatedData['due_date'] ?: null;
        $validatedData['issue_date'] = $validatedData['issue_date'] ?: null;

        // Ensure amount is not less than used amount
        if ($this->isEdit && $this->currentChequeUsedAmount > 0 && (float)$this->amount < $this->currentChequeUsedAmount) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_cannot_be_less_than_used') . ' (' . number_format($this->currentChequeUsedAmount, 2) . ')'
            ]);
        }

        // Complex Balance Validation (Ported from ChequeRequest)
        $this->validateBalance($validatedData['amount']);

        $service = app(ChequeService::class);

        try {
            if ($this->isEdit) {
                $service->update($this->chequeId, $validatedData);
                session()->flash('success', __('general.update_success_message'));
            } else {
                $service->store($validatedData);
                session()->flash('success', __('general.add_success_message'));
            }
            return redirect()->route('dashboard.cheques.index');
        } catch (\Exception $e) {
            $this->addError('general', $e->getMessage());
        }
    }

    protected function validateBalance($amount)
    {
        $contract = Contract::find($this->contract_id);
        if (!$contract) return;

        if ($this->is_deposit == 1) {
            if (round($amount, 2) > round($contract->deposit_amount, 2)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => __('contracts.amount_exceeds_deposit') . ' (' . number_format($contract->deposit_amount, 2) . ')'
                ]);
            }
            return;
        }

        // Rent balance check
        $contractRemaining = $contract->remaining_amount;
        $otherChequesQuery = Cheque::where('contract_id', $this->contract_id)->where('is_deposit', false);
        if ($this->isEdit) {
            $otherChequesQuery->where('id', '!=', $this->chequeId);
        }
        $totalOtherUnused = $otherChequesQuery->get()->sum('remaining_amount');
        $finalAllowed = max(0, $contractRemaining - $totalOtherUnused);

        // We only validate the "Unused" portion of the current input amount against the remaining contract balance
        $currentInputUnused = max(0, (float)$amount - $this->currentChequeUsedAmount);

        if (round($currentInputUnused, 2) > round($finalAllowed, 2)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('payments.amount_exceeds_remaining') . ' (' . number_format($finalAllowed + $this->currentChequeUsedAmount, 2) . ')'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.cheques.cheque-form');
    }
}
