<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentRequest;
use App\Services\Dashboard\PaymentService;
use App\Services\Dashboard\CompanyService;
use App\Models\Contract;
use App\Models\Cheque;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use App\Models\Property;
class PaymentsController extends Controller
{
    protected $paymentService, $companyService;

    public function __construct(PaymentService $paymentService, CompanyService $companyService)
    {
        $this->paymentService = $paymentService;
        $this->companyService = $companyService;
    }

    /**
     * Get contract details via AJAX (Balance, Paid, Cheques)
     */
    public function getContractDetails(Request $request, $id)
    {
        $contract = Contract::with(['payments', 'customer'])->findOrFail($id);
        $paymentId = $request->get('payment_id');

        // Load cheques associated with this contract
        // We include cheques that are NOT fully used yet OR the one currently being edited
        $cheques = Cheque::where('contract_id', $id)
            ->where('company_id', $contract->company_id)
            ->where('is_deposit', false)
            ->get()
            ->filter(function($cheque) use ($paymentId) {
                // If it's the cheque linked to the current payment being edited, always include it
                if ($paymentId && $cheque->payments()->where('payments.id', $paymentId)->exists()) {
                    return true;
                }
                // Otherwise, only include if it has balance left
                return $cheque->remaining_amount > 0;
            })
            ->values()
            ->map(function($cheque) {
                return [
                    'id' => $cheque->id,
                    'cheque_number' => $cheque->cheque_number,
                    'bank_name' => $cheque->bank_name,
                    'owner_name' => $cheque->cheque_owner_name,
                    'amount' => $cheque->amount, // Original Amount
                    'used_amount' => $cheque->used_amount,
                    'remaining_amount' => $cheque->remaining_amount,
                    'issue_date' => $cheque->issue_date ? $cheque->issue_date->format('Y-m-d') : '---',
                    'due_date' => $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---',
                ];
            });

        $original_total = Cheque::where('contract_id', $id)
            ->where('company_id', $contract->company_id)
            ->where('is_deposit', false)
            ->sum('amount');

        $current_payment_amount = 0;
        if ($paymentId) {
            $payment = Payment::find($paymentId);
            if ($payment && $payment->method === 'cheque') {
                $current_payment_amount = $payment->amount;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'total_amount' => round($contract->total_amount, 0),
                'total_paid' => round($contract->paid_amount, 0),
                'remaining' => round($contract->remaining_amount, 0),
                'cheques' => $cheques,
                'pending_cheques_total' => round($cheques->sum('remaining_amount') + (float)$current_payment_amount, 0),
                'pending_cheques_original_total' => round($original_total, 0),
                'pending_cheques_count' => $cheques->count(),
                'customer_id' => $contract->customer_id,
                'customer_name' => optional($contract->customer)->name,
                'property_name' => optional($contract->property)->name
            ]
        ]);
    }

    public function index(Request $request)
    {
        Gate::authorize('payments_read');

        $title = __('payments.payments');
        $payments = $this->paymentService->getAll($request);
        $companies = null;

        // Fetch Customers and Properties for Filters
        $customers = Customer::when(user()->company_id != 1, function($q) {
            return $q->where('company_id', user()->company_id);
        })->latest()->get();

        $properties = Property::when(user()->company_id != 1, function($q) {
            return $q->where('company_id', user()->company_id);
        })->latest()->get();

        // Calculate Stats
        $stats = [
            'total_amount' => $this->paymentService->getTotalAmount(),
            'this_month' => $this->paymentService->getThisMonthAmount(),
            'cheque_total' => $this->paymentService->getAmountByMethod('cheque'),
            'cash_online_total' => $this->paymentService->getAmountByMethod(['cash', 'online']),
        ];

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }

        if ($request->ajax()) {
            return view('dashboard.payments.partials._table', compact('payments', 'companies'))->render();
        }

        return view('dashboard.payments.index', compact('title', 'payments', 'companies', 'stats', 'customers', 'properties'));
    }

    public function create()
    {
        Gate::authorize('payments_create');

        $title = __('payments.add_payment');
        $contracts = Contract::with(['customer', 'property'])->latest()->get();
        $cheques = Cheque::where('is_deposit', false)->doesntHave('payments')->latest()->get();
        $companies = null;
        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }
        return view('dashboard.payments.create', compact('title', 'contracts', 'cheques', 'companies'));
    }

    public function show(string $id, Request $request)
    {
        Gate::authorize('payments_read');

        $payment = $this->paymentService->getOne($id);

        if ($request->ajax()) {
            return view('dashboard.payments.show', compact('payment'))->render();
        }

        return view('dashboard.payments.show', compact('payment'));
    }

    public function edit(string $id)
    {
        Gate::authorize('payments_update');

        $title = __('payments.edit_payment');
        $payment = $this->paymentService->getOne($id);
        $contracts = Contract::with(['customer', 'property'])->latest()->get();
        $cheques = Cheque::where('is_deposit', false)
            ->where(function ($query) use ($payment) {
                $query->doesntHave('payments')
                    ->orWhereHas('payments', function ($q) use ($payment) {
                        $q->where('id', $payment->id);
                    });
            })->latest()->get();

        $companies = null;
        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }

        return view('dashboard.payments.edit', compact('title', 'payment', 'contracts', 'cheques', 'companies'));
    }

    public function store(PaymentRequest $request)
    {
        Gate::authorize('payments_create');

        try {
            $payment = $this->paymentService->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message'),
                'data' => $payment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(PaymentRequest $request, string $id)
    {
        Gate::authorize('payments_update');

        try {
            $this->paymentService->update($id, $request->validated());
            $payment = $this->paymentService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $payment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message')
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        Gate::authorize('payments_delete');

        if ($request->ajax()) {
            try {
                $this->paymentService->delete($request->id);
                return response()->json([
                    'status' => true,
                    'message' => __('general.delete_success_message')
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => __('general.delete_error_message')
                ], 500);
            }
        }
    }
}
