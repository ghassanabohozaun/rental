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

    public $contract_id, $customer_id, $company_id;
    public $cheque_number, $amount, $issue_date, $due_date, $notes;
    public $status, $is_deposit;
    public $bank_name = ['ar' => '', 'en' => ''], $cheque_owner_name = ['ar' => '', 'en' => ''];

    public $validation_fail_nonce = 0;

    public $financials = [];
    public $projectedRemaining = 0, $availableToCover = 0, $currentChequeUsedAmount = 0;
    public $isContractFulfilled = false, $amountExceedsRemaining = false;
    public $paid_pct = 0, $pending_pct = 0, $paid_pct_previous = 0, $current_pct_dynamic = 0;
    public $smart_assistant_message = '', $dateWarning = '';

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
                return;
            }
        }

        $dateToCheck = $this->due_date ?: $this->issue_date;
        if ($dateToCheck) {
            $dateObj = \Carbon\Carbon::parse($dateToCheck);
            if ($dateObj->copy()->addMonths(6)->isPast()) {
                $this->dateWarning = __('cheques.date_too_old_warning') ?? 'تنبيه: تاريخ الشيك قديم (أكثر من 6 أشهر)';
            } elseif ($dateObj->copy()->subYear()->isFuture()) {
                $this->dateWarning = __('cheques.date_too_far_future_warning') ?? 'تنبيه: تاريخ الشيك بعيد جداً في المستقبل (أكثر من سنة)';
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

        // Sum of all other pending cheques (excluding current)
        $otherPendingCheques = $allCheques->where('status', 'pending')->where('id', '!=', $this->cheque->id);
        $totalOtherUnused = $otherPendingCheques->sum('remaining_amount');

        $insuranceCovered = $allCheques->where('is_deposit', true)->whereIn('status', ['pending', 'held', 'cleared'])->where('id', '!=', $this->cheque->id)->sum('amount');

        $this->financials = [
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining' => $remaining,
            'pending_total' => $pendingTotal,
            'pending_original' => $pendingOriginal,
            'deposit_amount' => $contract->deposit_amount,
            'other_pending_total' => $totalOtherUnused,
            'covered_by_cheques' => min($remaining, $totalOtherUnused),
            'uncovered_debt' => max(0.0, $remaining - $totalOtherUnused),
            'insurance_covered' => $insuranceCovered,
            'insurance_uncovered' => max(0.0, $contract->deposit_amount - $insuranceCovered),
        ];

        // Projected Remaining
        $contractRemaining = $remaining;

        // Current cheque unused portion
        $currentChequeUnused = max(0, (float) $this->amount - $this->currentChequeUsedAmount);

        if ($this->is_deposit == 1) {
            // For insurance cheques, we check against deposit amount
            $this->projectedRemaining = $contract->deposit_amount - $totalOtherUnused - $currentChequeUnused;
        } else {
            $this->projectedRemaining = $contractRemaining - $totalOtherUnused - $currentChequeUnused;
        }

        // We don't need to check if contract is fully covered in edit mode to block saving,
        // but we can set it for UI purposes if needed.
        $this->isContractFulfilled = false;

        // Exceeds remaining validation display
        $this->availableToCover = max(0, (float)($totalAmount - $paidAmount - $totalOtherUnused)) + $this->currentChequeUsedAmount;
        if ($this->is_deposit == 0 && (float)$this->amount > $this->availableToCover) {
            $this->amountExceedsRemaining = true;
        } else {
            $this->amountExceedsRemaining = false;
        }

        // Progress bar calculations
        if ($this->is_deposit == 1) {
            $total = $contract->deposit_amount ?: 1;
            
            $realizedPrevious = $allCheques->where('is_deposit', true)->whereIn('status', ['cleared', 'held'])->where('id', '!=', $this->cheque->id)->sum('amount');
            $pendingPrevious = $allCheques->where('is_deposit', true)->where('status', 'pending')->where('id', '!=', $this->cheque->id)->sum('amount');

            $this->paid_pct_previous = ($realizedPrevious / $total) * 100;
            $this->pending_pct = ($pendingPrevious / $total) * 100;
            
            $currentAmt = 0;
            if (in_array($this->status, ['pending', 'held', 'cleared'])) {
                $currentAmt = max(0, (float) $this->amount);
            }
            $this->current_pct_dynamic = ($currentAmt / $total) * 100;
            
            $this->paid_pct = $this->paid_pct_previous + $this->current_pct_dynamic;
        } else {
            $total = $totalAmount ?: 1;

            // Realized Paid (Cash/Bank, or Cleared Cheques)
            $realizedPaid = $contract->payments()
                ->whereIn('status', ['paid', 'pending'])
                ->where(function ($query) {
                    $query->whereNull('cheque_id')
                        ->orWhereHas('cheque', function ($q) {
                            $q->where('is_deposit', false)->where('status', 'cleared')->where('id', '!=', $this->cheque->id);
                        });
                })
                ->sum('amount');
            
            // Pending Cheques (excluding current)
            $pendingChequeVal = 0;
            $pendingChequeVal += $contract->payments()
                ->whereIn('status', ['paid', 'pending'])
                ->whereHas('cheque', function ($q) {
                    $q->where('is_deposit', false)
                      ->where('status', 'pending')
                      ->where('id', '!=', $this->cheque->id);
                })
                ->sum('amount');
            $pendingChequeVal += $allCheques
                ->where('is_deposit', false)
                ->where('status', 'pending')
                ->where('id', '!=', $this->cheque->id)
                ->sum('remaining_amount');

            $this->paid_pct_previous = ($realizedPaid / $total) * 100;
            $this->pending_pct = ($pendingChequeVal / $total) * 100;
            
            $currentAmt = 0;
            if (in_array($this->status, ['pending', 'held', 'cleared'])) {
                $currentAmt = max(0, (float) $this->amount);
            }
            $this->current_pct_dynamic = ($currentAmt / $total) * 100;
            
            $this->paid_pct = $this->paid_pct_previous + $this->current_pct_dynamic;
        }

        $this->updateSmartAssistantMessage();
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
            'covered_by_cheques' => 0,
            'uncovered_debt' => 0,
            'insurance_covered' => 0,
            'insurance_uncovered' => 0,
        ];
        $this->projectedRemaining = 0;
        $this->isContractFulfilled = false;
        $this->amountExceedsRemaining = false;
        $this->availableToCover = 0;
        $this->paid_pct = 0;
        $this->pending_pct = 0;
        $this->paid_pct_previous = 0;
        $this->current_pct_dynamic = 0;
        $this->smart_assistant_message = '';
    }

    public function updateSmartAssistantMessage()
    {
        if (!$this->contract_id) {
            $this->smart_assistant_message = __('cheques.smart_assistant.select_contract');
            return;
        }

        $amt = (float)$this->amount;
        if ($amt <= 0) {
            $this->smart_assistant_message = __('cheques.smart_assistant.enter_cheque_value');
            return;
        }

        if ($this->is_deposit == 1) {
            $uncovered = (float)$this->financials['insurance_uncovered'];
            
            if ($amt > $uncovered) {
                $surplus = $amt - $uncovered;
                $this->smart_assistant_message = __('cheques.smart_assistant.deposit_exceeds', ['amount' => number_format($surplus, 0)]);
            } else {
                $newUncovered = $uncovered - $amt;
                if ($newUncovered <= 0) {
                    $this->smart_assistant_message = __('cheques.smart_assistant.deposit_fully_covered');
                } else {
                    $this->smart_assistant_message = __('cheques.smart_assistant.deposit_partially_covered_edit', ['amount' => number_format($newUncovered, 0)]);
                }
            }
        } else {
            $uncovered = (float)$this->financials['uncovered_debt'];
            
            if ($amt > $this->availableToCover + $this->currentChequeUsedAmount + 0.01) {
                $this->smart_assistant_message = __('cheques.smart_assistant.rent_exceeds_general');
            } else {
                $newUncovered = max(0, $uncovered - $amt);
                if ($newUncovered == 0) {
                    $this->smart_assistant_message = __('cheques.smart_assistant.rent_fully_covered');
                } else {
                    $this->smart_assistant_message = __('cheques.smart_assistant.rent_partially_covered_edit', ['amount' => number_format($newUncovered, 0)]);
                }
            }
        }
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
            'status' => 'required|string|in:pending,cleared,bounced,held,returned',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        try {
            $validatedData = $this->validate($rules);

            $validatedData['is_deposit'] = $this->is_deposit;
            $validatedData['due_date'] = $validatedData['due_date'] ?: null;
            $validatedData['issue_date'] = $validatedData['issue_date'] ?: null;

            // Ensure amount is not less than used amount
            if ($this->currentChequeUsedAmount > 0 && (float) $this->amount < $this->currentChequeUsedAmount) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => __('cheques.amount_cannot_be_less_than_used') . ' (' . number_format($this->currentChequeUsedAmount, 2) . ')',
                ]);
            }

            // Prevent Duplication
            $this->validateDuplicate($validatedData);

            // Complex Balance Validation
            $this->validateBalance($validatedData['amount']);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->validation_fail_nonce++;
            $this->dispatch('reinit-plugins');
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

        $service = app(ChequeService::class);

        try {
            $service->update($this->cheque->id, $validatedData);
            session()->flash('success', __('general.update_success_message'));
            return redirect()->route('dashboard.cheques.index');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Livewire Update Error: ' . $e->getMessage());
            $this->addError('general', $e->getMessage());
            $this->dispatch('notify', message: $e->getMessage(), type: 'error');
        }
    }

    protected function validateDuplicate($validatedData)
    {
        $companyId = $validatedData['company_id'] ?? $this->company_id;
        $query = Cheque::where('company_id', $companyId)
            ->where('cheque_number', $validatedData['cheque_number'])
            ->where('id', '!=', $this->cheque->id)
            ->where(function ($q) use ($validatedData) {
                $q->where('bank_name->ar', $validatedData['bank_name']['ar'])->orWhere('bank_name->en', $validatedData['bank_name']['en']);
            });

        if ($query->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'cheque_number' => __('cheques.duplicate_cheque_number'),
            ]);
        }
    }

    protected function validateBalance($amount)
    {
        if ($this->is_deposit == 1) {
            return;
        }

        $contract = Contract::with('cheques')->find($this->contract_id);
        $totalAmount = $contract->total_amount;
        $paidAmount = $contract->paid_amount;

        $otherCheques = $contract->cheques->where('status', 'pending')->where('id', '!=', $this->cheque->id);

        $otherPendingTotal = $otherCheques->sum('remaining_amount');
        $availableToCover = max(0, $totalAmount - $paidAmount - $otherPendingTotal);

        if ($amount > $availableToCover + $this->currentChequeUsedAmount + 0.01) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('cheques.amount_exceeds_contract_remaining') . ' (' . number_format($availableToCover + $this->currentChequeUsedAmount, 2) . ')',
            ]);
        }
    }

    public function render()
    {
        $companies = Company::active()
            ->orWhere('id', $this->company_id)
            ->orderBy('id', 'desc')
            ->get();
        $contracts = collect();
        if ($this->company_id) {
            $contracts = Contract::where('company_id', $this->company_id)->with('customer', 'property')->orderBy('id', 'desc')->get();
        }

        return view('livewire.dashboard.cheques.edit-cheque', [
            'companies' => $companies,
            'contracts' => $contracts,
        ]);
    }
}
