<?php

namespace App\Livewire\Dashboard\Payments;

use App\Models\Cheque;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Payment;
use App\Services\Dashboard\PaymentService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class PaymentForm extends Component
{
    // Mode
    public $isEdit = false;
    public $paymentId;

    // Form Fields
    public $validation_fail_nonce = 0;
    public $company_id;
    public $contract_id;
    public $customer_id;
    public $method;
    public $amount;
    public $payment_date;
    public $cheque_id;
    public $company_bank_account_id;
    public $status;
    public $reference_number;
    public $notes;

    // Data Collections
    public $companies;
    public $contracts;
    public $availableCheques = [];
    
    // Financial Summaries
    public $financials = [
        'total_amount' => 0,
        'paid_amount' => 0,
        'remaining' => 0,
        'pending_cheques_total' => 0,
        'pending_cheques_original_total' => 0,
        'pending_cheques_count' => 0,
        'paid_pct' => 0,
        'pending_pct' => 0,
        'covered_by_cheques' => 0,
        'uncovered_debt' => 0,
    ];

    public $projectedRemaining = 0;

    public $selectedChequeDetails = null;

    public $paid_pct_dynamic = 0;
    public $pending_pct_dynamic = 0;
    public $paid_pct_previous = 0;
    public $current_pct_dynamic = 0;
    public $smart_assistant_message = '';
    public $hasOverCoverage = false;
    public $amountExceedsRemaining = false;

    protected $listeners = ['reinit-plugins' => '$refresh'];

    public function mount($paymentId = null)
    {
        $this->payment_date = null;
        $this->loadInitialData();

        if ($paymentId) {
            $this->isEdit = true;
            $this->paymentId = $paymentId;
            $this->loadPaymentData($paymentId);
        } else {
            if (user()->company_id != 1) {
                $this->company_id = user()->company_id;
            }

            if (request()->has('contract_id')) {
                $contract = Contract::find(request('contract_id'));
                if ($contract) {
                    $this->company_id = $contract->company_id;
                    if (user()->company_id == 1) {
                        $this->loadContractsByCompany();
                    }
                    $this->contract_id = $contract->id;
                    $this->loadContractDetails();
                }
            }

            if (request()->has('cheque_id')) {
                $this->method = 'cheque';
                $this->status = 'paid'; // Default to paid because the context is "Cashing" (تسييل)
                $this->cheque_id = request('cheque_id');
                $this->loadSelectedChequeDetails();
                if ($this->selectedChequeDetails) {
                    $this->amount = $this->selectedChequeDetails['remaining_amount'];
                    if (!empty($this->selectedChequeDetails['due_date'])) {
                        $this->payment_date = $this->selectedChequeDetails['due_date'];
                    }
                }
            }
        }
        $this->calculateProjected();
        $this->calculateProgressBar();
    }

    protected function loadInitialData()
    {
        if (user()->company_id == 1) {
            if ($this->isEdit && $this->company_id) {
                $this->companies = Company::active()
                    ->orWhere('id', $this->company_id)
                    ->orderByDesc('id')
                    ->get();
            } else {
                $this->companies = Company::active()->orderByDesc('id')->get();
            }
            $this->contracts = []; // Keep empty for super admin until company is selected
        } else {
            $this->company_id = user()->company_id;
            $this->loadContractsByCompany();
        }
    }

    protected function loadPaymentData($id)
    {
        $payment = Payment::findOrFail($id);
        
        $this->company_id = $payment->company_id;
        $this->loadContractsByCompany();
        $this->contract_id = $payment->contract_id;
        $this->customer_id = $payment->customer_id;
        $this->method = $payment->method;
        $this->amount = $payment->amount;
        $this->payment_date = $payment->payment_date->format('d-m-Y');
        $this->cheque_id = $payment->cheque_id;
        $this->company_bank_account_id = $payment->company_bank_account_id;
        $this->status = $payment->status;
        $this->reference_number = $payment->reference_number;
        $this->notes = $payment->notes;

        $this->loadContractDetails();
        
        if ($this->cheque_id) {
            $this->loadSelectedChequeDetails();
        }
    }

    public function updatedCompanyId($value)
    {
        $this->contract_id = null;
        $this->company_bank_account_id = null;
        $this->resetFinancials();
        $this->resetPaymentFields();
        $this->loadContractsByCompany();
        $this->dispatch('reinit-plugins');
    }

    public function updatedContractId($value)
    {
        $this->resetPaymentFields();
        if ($value) {
            $this->loadContractDetails();
            $this->calculateProjected();
        } else {
            $this->resetFinancials();
        }
        $this->calculateProgressBar();
        $this->dispatch('reinit-plugins');
    }

    protected function loadContractsByCompany()
    {
        if (user()->company_id != 1) {
            $this->company_id = user()->company_id;
        }

        if ($this->company_id) {
            $this->contracts = Contract::with(['customer', 'property'])
                ->where('company_id', $this->company_id)
                ->latest()
                ->get();
        } else {
            $this->contracts = [];
        }
    }

    protected function resetPaymentFields()
    {
        $this->method = '';
        $this->amount = null;
        $this->cheque_id = null;
        $this->company_bank_account_id = null;
        $this->status = '';
        $this->reference_number = null;
        $this->selectedChequeDetails = null;
    }

    protected function resetFinancials()
    {
        $this->financials = [
            'total_amount' => 0,
            'paid_amount' => 0,
            'remaining' => 0,
            'pending_cheques_total' => 0,
            'pending_cheques_original_total' => 0,
            'pending_cheques_count' => 0,
            'paid_pct' => 0,
            'pending_pct' => 0,
            'covered_by_cheques' => 0,
            'uncovered_debt' => 0,
        ];
    }

    /** @var \Illuminate\Support\Collection */
    public $allCheques;

    public function loadContractDetails()
    {
        if (!$this->contract_id) return;

        $contract = Contract::with(['payments', 'customer', 'cheques'])->findOrFail($this->contract_id);
        $this->customer_id = $contract->customer_id;

        // Load Cheques
        $chequesQuery = Cheque::where('contract_id', $this->contract_id)
            ->where('is_deposit', false);

        $this->allCheques = $chequesQuery->latest()->get();
        
        $this->availableCheques = $this->allCheques->filter(function($cheque) {
            if ($this->isEdit && $cheque->id == $this->cheque_id) return true;
            return $cheque->remaining_amount > 0;
        })->values()->toArray();

        // Calculate Financials
        $total = (float)$contract->total_amount;
        $paid = (float)$contract->paid_amount;
        
        $remaining = (float)$contract->remaining_amount;
        $pendingTotal = $this->allCheques->sum('remaining_amount');
        $originalTotal = $this->allCheques->sum('amount');

        $this->financials = [
            'total_amount' => $total,
            'paid_amount' => $paid,
            'remaining' => $remaining,
            'pending_cheques_total' => $pendingTotal,
            'pending_cheques_original_total' => $originalTotal,
            'pending_cheques_count' => $this->allCheques->count(),
            'paid_pct' => $total > 0 ? ($paid / $total) * 100 : 0,
            'pending_pct' => $total > 0 ? ($pendingTotal / $total) * 100 : 0,
            'covered_by_cheques' => min($remaining, $pendingTotal),
            'uncovered_debt' => max(0.0, $remaining - $pendingTotal),
            'customer_name' => optional($contract->customer)->name,
            'property_name' => optional($contract->property)->name,
        ];
    }

    public function updatedAmount($value)
    {
        $this->calculateProjected();
        $this->calculateProgressBar();
    }

    public function calculateProjected()
    {
        if (!$this->contract_id) {
            $this->projectedRemaining = 0;
            return;
        }

        $amt = (float) $this->amount;
        $remaining = (float)$this->financials['remaining'];

        // If editing, we need to handle the case where the current payment is already part of the remaining
        if ($this->isEdit) {
            $payment = Payment::find($this->paymentId);
            if ($payment && $payment->status === 'paid') {
                $remaining += (float)$payment->amount;
            }
        }

        // Sum remaining of all pending cheques
        $contract = Contract::with('cheques')->find($this->contract_id);
        $pendingChequesVal = 0;
        if ($contract) {
            $pendingChequesVal = $contract->cheques
                ->where('is_deposit', false)
                ->where('status', 'pending')
                ->sum('remaining_amount');

            // If editing and the payment is linked to a pending cheque, the cheque's remaining_amount was reduced by this payment.
            // We should add it back to get the original state.
            if ($this->isEdit && $this->method === 'cheque' && $this->cheque_id) {
                $payment = Payment::find($this->paymentId);
                if ($payment && $payment->cheque_id == $this->cheque_id && in_array($payment->status, ['paid', 'pending'])) {
                    $pendingChequesVal += (float)$payment->amount;
                }
            }
        }

        // Subtract pending cheques and this payment (unless this payment is cheque-backed, in which case the cheque is already in $pendingChequesVal)
        if ($this->method === 'cheque' && $this->cheque_id) {
            // Cheque-backed payment: the cheque already covers it, so we don't subtract $amt (it's not new money).
            $this->projectedRemaining = $remaining - $pendingChequesVal;
        } else {
            // Cash or online payment: this is new money being added.
            $this->projectedRemaining = $remaining - $pendingChequesVal - $amt;
        }
        $this->updateSmartAssistantMessage();
    }

    public function updatedMethod($value)
    {
        if ($value === 'cheque') {
            $this->status = 'pending';
        } else {
            $this->cheque_id = null;
            $this->selectedChequeDetails = null;
            $this->status = '';
        }
        if ($value !== 'bank') {
            $this->company_bank_account_id = null;
        }
        $this->calculateProjected();
        $this->calculateProgressBar();
        $this->dispatch('reinit-plugins');
    }

    public function updatedChequeId($value)
    {
        if ($value) {
            $this->loadSelectedChequeDetails();
            if ($this->selectedChequeDetails && !empty($this->selectedChequeDetails['due_date'])) {
                $this->payment_date = $this->selectedChequeDetails['due_date'];
                // optionally dispatch an event if date picker needs reinit
                $this->dispatch('reinit-plugins');
            }
        } else {
            $this->selectedChequeDetails = null;
        }
        $this->calculateProjected();
        $this->calculateProgressBar();
    }

    public function updatedStatus($value)
    {
        $this->calculateProjected();
        $this->calculateProgressBar();
    }

    public function calculateProgressBar()
    {
        if (!$this->contract_id) {
            $this->paid_pct_dynamic = 0;
            $this->pending_pct_dynamic = 0;
            return;
        }

        $contract = Contract::with(['payments.cheque', 'cheques'])->find($this->contract_id);
        if (!$contract) {
            $this->paid_pct_dynamic = 0;
            $this->pending_pct_dynamic = 0;
            return;
        }

        $total = (float)$contract->total_amount ?: 1;
        $realizedPaid = 0;
        $pendingChequesVal = 0;

        // 1. Process existing DB payments (excluding deposit-linked ones)
        foreach ($contract->payments as $p) {
            if ($this->isEdit && $this->paymentId && $p->id == $this->paymentId) continue;
            if ($p->cheque_id && $p->cheque && $p->cheque->is_deposit) continue;

            if (in_array($p->status, ['paid', 'pending'])) {
                if ($p->cheque_id && $p->cheque) {
                    if ($p->cheque->status === 'cleared') {
                        $realizedPaid += $p->amount;
                    } else {
                        $pendingChequesVal += $p->amount;
                    }
                } else {
                    if ($p->method === 'cheque' && $p->status === 'pending') {
                        $pendingChequesVal += $p->amount;
                    } else {
                        $realizedPaid += $p->amount;
                    }
                }
            }
        }

        // 2. Process non-deposit cheques remaining balances
        $currentAmt = (float)$this->amount;
        foreach ($contract->cheques->where('is_deposit', false) as $chq) {
            if ($chq->status === 'pending') {
                $chqRemaining = (float)$chq->remaining_amount;

                if ($this->method === 'cheque' && $this->cheque_id && $chq->id == $this->cheque_id) {
                    // In edit mode, add back the old payment amount to restore cheque balance
                    if ($this->isEdit && $this->paymentId) {
                        $oldPayment = \App\Models\Payment::find($this->paymentId);
                        if ($oldPayment && $oldPayment->cheque_id == $this->cheque_id) {
                            $chqRemaining += (float)$oldPayment->amount;
                        }
                    }
                    $chqRemaining = max(0, $chqRemaining - $currentAmt);
                }

                $pendingChequesVal += $chqRemaining;
            }
        }

        // 3. Account for the current payment being entered
        $realizedPaidPrevious = $realizedPaid;
        
        if ($this->status !== 'failed') {
            $this->current_pct_dynamic = ($currentAmt / $total) * 100;
        } else {
            $this->current_pct_dynamic = 0;
        }
        
        $this->paid_pct_previous = ($realizedPaidPrevious / $total) * 100;
        $this->pending_pct_dynamic = ($pendingChequesVal / $total) * 100;
        
        $this->paid_pct_dynamic = $this->paid_pct_previous + ($this->method !== 'cheque' ? $this->current_pct_dynamic : 0);
        
        $this->amountExceedsRemaining = false;
        $this->hasOverCoverage = false;
        
        $remaining = (float)$this->financials['remaining'];
        if ($this->isEdit && $this->paymentId) {
            $oldPayment = \App\Models\Payment::find($this->paymentId);
            if ($oldPayment && $oldPayment->status === 'paid') {
                $remaining += (float)$oldPayment->amount;
            }
        }

        if ($currentAmt > $remaining) {
            $this->amountExceedsRemaining = true;
        } elseif (($this->paid_pct_previous + $this->current_pct_dynamic + $this->pending_pct_dynamic) > 100.01) {
            $this->hasOverCoverage = true;
        }
        $this->updateSmartAssistantMessage();
    }

    public function updateSmartAssistantMessage()
    {
        if (!$this->contract_id) {
            $this->smart_assistant_message = __('payments.smart_assistant.select_contract');
            return;
        }

        $remaining = (float)$this->financials['remaining'];
        if ($remaining <= 0 && !$this->isEdit) {
            $this->smart_assistant_message = __('payments.smart_assistant.contract_fully_paid');
            return;
        }

        $amt = (float)$this->amount;
        if (!$this->method || $amt <= 0) {
            $this->smart_assistant_message = __('payments.smart_assistant.select_method_and_amount');
            return;
        }

        $uncovered = (float)$this->financials['uncovered_debt'];

        if ($this->method !== 'cheque') {
            if ($amt > $remaining) {
                $this->smart_assistant_message = __('payments.smart_assistant.amount_exceeds_remaining', [
                    'amount' => number_format($amt, 2),
                    'remaining' => number_format($remaining, 2)
                ]);
            } elseif ($amt > $uncovered) {
                $surplus = $amt - $uncovered;
                $this->smart_assistant_message = __('payments.smart_assistant.cash_surplus', [
                    'amount' => number_format($amt, 2),
                    'surplus' => number_format($surplus, 2)
                ]);
            } else {
                $newUncovered = $uncovered - $amt;
                $this->smart_assistant_message = __('payments.smart_assistant.cash_partially_covered', [
                    'amount' => number_format($amt, 2),
                    'uncovered' => number_format($uncovered, 2),
                    'new_uncovered' => number_format($newUncovered, 2)
                ]);
            }
        } else {
            if (!$this->cheque_id) {
                $this->smart_assistant_message = __('payments.smart_assistant.select_cheque_to_cash');
                return;
            }

            if ($this->selectedChequeDetails) {
                $chqNo = $this->selectedChequeDetails['cheque_number'];
                $chqRemaining = (float)$this->selectedChequeDetails['remaining_amount'];

                if ($this->isEdit && $this->paymentId) {
                    $oldPayment = Payment::find($this->paymentId);
                    if ($oldPayment && $oldPayment->cheque_id == $this->cheque_id) {
                        $chqRemaining += (float)$oldPayment->amount;
                    }
                }

                if ($amt > $chqRemaining) {
                    $this->smart_assistant_message = __('payments.smart_assistant.cheque_amount_exceeds', [
                        'amount' => number_format($amt, 2),
                        'remaining' => number_format($chqRemaining, 2)
                    ]);
                } else {
                    $newChqRemaining = $chqRemaining - $amt;
                    $this->smart_assistant_message = __('payments.smart_assistant.cheque_cash_flow', [
                        'amount' => number_format($amt, 2),
                        'cheque_no' => $chqNo,
                        'new_remaining' => number_format($newChqRemaining, 2)
                    ]);
                }
            } else {
                $this->smart_assistant_message = __('payments.smart_assistant.select_valid_cheque');
            }
        }
    }

    protected function loadSelectedChequeDetails()
    {
        $cheque = Cheque::find($this->cheque_id);
        if ($cheque) {
            $this->selectedChequeDetails = [
                'id' => $cheque->id,
                'cheque_number' => $cheque->cheque_number,
                'bank_name' => $cheque->bank_name,
                'amount' => $cheque->amount,
                'used_amount' => $cheque->used_amount,
                'remaining_amount' => $cheque->remaining_amount,
                'due_date' => $cheque->due_date ? $cheque->due_date->format('Y-m-d') : null,
            ];
        }
    }

    public function save()
    {
        $this->isEdit ? Gate::authorize('payments_update') : Gate::authorize('payments_create');

        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'method' => 'required|in:cash,cheque,online,bank',
            'amount' => 'required|numeric|gt:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,pending,failed',
            'notes' => 'nullable|string',
            'reference_number' => 'nullable|string|max:255',
        ];

        if ($this->method === 'cheque') {
            $rules['cheque_id'] = 'required|exists:cheques,id';
        }

        if ($this->method === 'bank') {
            $rules['company_bank_account_id'] = 'required|exists:company_bank_accounts,id';
        }

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        try {
            $validatedData = $this->validate($rules);
            
            if (isset($validatedData['payment_date'])) {
                $validatedData['payment_date'] = \Carbon\Carbon::parse($validatedData['payment_date'])->format('Y-m-d');
            }

            $validatedData['customer_id'] = $this->customer_id;
            $validatedData['company_bank_account_id'] = $this->method === 'bank' ? $this->company_bank_account_id : null;

            // Custom Validation
            $this->validateBalance($validatedData['amount']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->validation_fail_nonce++;
            $this->dispatch('reinit-plugins');
            $errors = $e->validator->errors()->all();
            $this->dispatch('notify', message: count($errors) === 1 ? $errors[0] : __('general.validation_error_message'), type: 'error');
            throw $e;
        }

        $service = app(PaymentService::class);

        try {
            if ($this->isEdit) {
                $service->update($this->paymentId, $validatedData);
                session()->flash('success', __('general.update_success_message'));
            } else {
                $service->store($validatedData);
                session()->flash('success', __('general.add_success_message'));
            }
            return redirect()->route('dashboard.payments.index');
        } catch (\Exception $e) {
            \Log::error('Payment Save Error: ' . $e->getMessage());
            $this->addError('general', $e->getMessage());
            $this->dispatch('notify', message: $e->getMessage(), type: 'error');
        }
    }

    protected function validateBalance($amount)
    {
        $contract = Contract::find($this->contract_id);
        if (!$contract) return;

        $remaining = (float)$contract->remaining_amount;
        
        // If editing, we add back the current payment amount to the remaining
        if ($this->isEdit) {
            $oldPayment = Payment::find($this->paymentId);
            if ($oldPayment && $oldPayment->status === 'paid') {
                $remaining += (float)$oldPayment->amount;
            }
        }

        if (round($amount, 2) > round($remaining, 2)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'amount' => __('payments.amount_exceeds_remaining') . ' (' . number_format($remaining, 2) . ')'
            ]);
        }

        if ($this->method === 'cheque' && $this->cheque_id) {
            $cheque = Cheque::find($this->cheque_id);
            $chequeRemaining = (float)$cheque->remaining_amount;
            
            if ($this->isEdit) {
                $oldPayment = Payment::find($this->paymentId);
                if ($oldPayment && $oldPayment->cheque_id == $this->cheque_id) {
                    $chequeRemaining += (float)$oldPayment->amount;
                }
            }

            if (round($amount, 2) > round($chequeRemaining, 2)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => __('payments.amount_exceeds_cheque') . ' (' . number_format($chequeRemaining, 2) . ')'
                ]);
            }
        }
    }

    public function render()
    {
        $companyBankAccounts = collect();
        if ($this->company_id) {
            $companyBankAccounts = \App\Models\CompanyBankAccount::where('company_id', $this->company_id)
                ->orderBy('id', 'desc')
                ->get();
        }
        return view('livewire.dashboard.payments.payment-form', [
            'companyBankAccounts' => $companyBankAccounts
        ]);
    }
}
