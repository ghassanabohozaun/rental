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
    public $company_id;
    public $contract_id;
    public $customer_id;
    public $method = 'cash';
    public $amount;
    public $payment_date;
    public $cheque_id;
    public $status = 'paid';
    public $reference_number;
    public $notes;

    // Data Collections
    public $companies = [];
    public $contracts = [];
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
    ];

    public $projectedRemaining = 0;

    public $selectedChequeDetails = null;

    protected $listeners = ['reinit-plugins' => '$refresh'];

    public function mount($paymentId = null)
    {
        $this->payment_date = date('Y-m-d');
        $this->loadInitialData();

        if ($paymentId) {
            $this->isEdit = true;
            $this->paymentId = $paymentId;
            $this->loadPaymentData($paymentId);
        } else {
            if (user()->company_id != 1) {
                $this->company_id = user()->company_id;
            }
        }
        $this->calculateProjected();
    }

    protected function loadInitialData()
    {
        if (user()->company_id == 1) {
            $this->companies = Company::all();
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
        $this->contract_id = $payment->contract_id;
        $this->customer_id = $payment->customer_id;
        $this->method = $payment->method;
        $this->amount = $payment->amount;
        $this->payment_date = $payment->payment_date->format('Y-m-d');
        $this->cheque_id = $payment->cheque_id;
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
        $this->method = 'cash';
        $this->amount = null;
        $this->cheque_id = null;
        $this->status = 'paid';
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
        ];
    }

    public $allCheques = [];

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
        
        // Adjust paid if we are editing an existing payment
        if ($this->isEdit) {
            $currentPayment = Payment::find($this->paymentId);
            if ($currentPayment && $currentPayment->status === 'paid') {
                // If the current payment is already counted in contract->paid_amount, we don't subtract it here
                // because we want to see the state AS IT IS.
            }
        }

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
            'customer_name' => optional($contract->customer)->name,
            'property_name' => optional($contract->property)->name,
        ];
    }

    public function updatedAmount($value)
    {
        $this->calculateProjected();
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

        $this->projectedRemaining = max(0, $remaining - $amt);
    }

    public function updatedMethod($value)
    {
        if ($value === 'cheque') {
            $this->status = 'pending';
        } else {
            $this->cheque_id = null;
            $this->selectedChequeDetails = null;
            $this->status = 'paid';
        }
        $this->dispatch('reinit-plugins');
    }

    public function updatedChequeId($value)
    {
        if ($value) {
            $this->loadSelectedChequeDetails();
            // Auto-fill amount with remaining cheque balance
            if ($this->selectedChequeDetails) {
                $this->amount = $this->selectedChequeDetails['remaining_amount'];
            }
        } else {
            $this->selectedChequeDetails = null;
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
            ];
        }
    }

    public function save()
    {
        $this->isEdit ? Gate::authorize('payments_update') : Gate::authorize('payments_create');

        $rules = [
            'contract_id' => 'required|exists:contracts,id',
            'method' => 'required|in:cash,cheque,online',
            'amount' => 'required|numeric|gt:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,pending,failed',
            'notes' => 'nullable|string',
            'reference_number' => 'nullable|string|max:255',
        ];

        if ($this->method === 'cheque') {
            $rules['cheque_id'] = 'required|exists:cheques,id';
        }

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validatedData = $this->validate($rules);
        $validatedData['customer_id'] = $this->customer_id;

        // Custom Validation
        $this->validateBalance($validatedData['amount']);

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
        return view('livewire.dashboard.payments.payment-form');
    }
}
