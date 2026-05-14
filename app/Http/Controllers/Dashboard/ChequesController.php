<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChequeRequest;
use App\Services\Dashboard\ChequeService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;
use App\Models\Contract;
use App\Models\Cheque;
use App\Models\Customer;

class ChequesController extends Controller
{
    protected $chequeService, $companyService;

    public function __construct(ChequeService $chequeService, CompanyService $companyService)
    {
        $this->chequeService = $chequeService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('cheques_read');

        $title = __('cheques.cheques');
        
        // Default to Rent Cheques (is_deposit = 0) if not explicitly filtered
        if (!$request->has('is_deposit')) {
            $request->merge(['is_deposit' => 0]);
        }

        $cheques = $this->chequeService->getAll($request);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }

        $customers = Customer::active()->get();
        $properties = \App\Models\Property::get();
        $stats = $this->chequeService->getStats();

        if ($request->ajax()) {
            return view('dashboard.cheques.partials._table', compact('cheques', 'companies', 'customers', 'properties'))->render();
        }

        return view('dashboard.cheques.index', compact('title', 'cheques', 'companies', 'customers', 'properties', 'stats'));
    }

    public function create(Request $request)
    {
        Gate::authorize('cheques_create');

        $is_deposit = $request->get('is_deposit', 0);
        $contract_id = $request->get('contract_id');
        $company_id = $request->get('company_id');
        $title = $is_deposit == 1 ? __('cheques.add_insurance_cheque') : __('cheques.add_cheque');

        $contracts = Contract::with(['customer', 'property'])->orderBy('id', 'desc')->get();
        $customers = Customer::active()->get();
        $companies = null;
        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }
        return view('dashboard.cheques.create', compact('title', 'contracts', 'customers', 'companies', 'is_deposit', 'contract_id', 'company_id'));
    }

    public function show(string $id, Request $request)
    {
        Gate::authorize('cheques_read');

        $cheque = $this->chequeService->getOne($id);
        
        if ($request->ajax()) {
            return view('dashboard.cheques.show', compact('cheque'))->render();
        }

        return view('dashboard.cheques.show', compact('cheque'));
    }

    public function edit(string $id)
    {
        Gate::authorize('cheques_update');

        $title = __('cheques.edit_cheque');
        $cheque = $this->chequeService->getOne($id);
        $contracts = Contract::with(['customer', 'property'])->orderBy('id', 'desc')->get();
        $customers = Customer::active()->get();
        $companies = null;
        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }
        return view('dashboard.cheques.edit', compact('title', 'cheque', 'contracts', 'customers', 'companies'));
    }

    public function store(ChequeRequest $request)
    {
        Gate::authorize('cheques_create');

        try {
            $cheque = $this->chequeService->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message'),
                'data' => $cheque
            ], 200);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(ChequeRequest $request, string $id)
    {
        Gate::authorize('cheques_update');

        try {
            $this->chequeService->update($id, $request->validated());
            $cheque = $this->chequeService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $cheque
            ], 201);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cheque Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message')
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        Gate::authorize('cheques_delete');

        if ($request->ajax()) {
            try {
                $this->chequeService->delete($request->id);
                return response()->json([
                    'status' => true,
                    'message' => __('general.delete_success_message')
                ], 200);
            } catch (DeleteRestrictionException $e) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage()
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => __('general.delete_error_message')
                ], 500);
            }
        }
    }

    public function autocomplete(Request $request)
    {
        $data = $this->chequeService->autocomplete($request->get('q'));
        return response()->json($data);
    }

    /**
     * Get contract details via AJAX (Balance, Paid)
     */
    public function getContractDetails($id)
    {
        $contract = Contract::with(['payments', 'customer', 'property'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'total_amount' => round($contract->total_amount, 0),
                'total_paid' => round($contract->paid_amount, 0),
                'remaining' => round($contract->remaining_amount, 0),
                'total_pending_rent' => round($contract->cheques()->where('is_deposit', false)->get()->sum('remaining_amount'), 0),
                'total_pending_rent_original' => round($contract->cheques()->where('is_deposit', false)->sum('amount'), 0),
                'deposit_amount' => round($contract->deposit_amount, 0),
                'has_insurance_cheque' => $contract->insuranceCheque()->exists(),
                'customer_id' => $contract->customer_id,
                'customer_name' => optional($contract->customer)->name,
                'property_name' => optional($contract->property)->name
            ]
        ]);
    }

    public function returnCheque(Request $request, $id)
    {
        Gate::authorize('cheques_update');
        try {
            $this->chequeService->returnCheque($id);
            return response()->json([
                'status' => true,
                'message' => __('cheques.cheque_returned_successfully') ?? 'تم إرجاع الشيك بنجاح'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cashCheque(Request $request, $id)
    {
        Gate::authorize('cheques_update');
        try {
            $this->chequeService->cashCheque($id);
            return response()->json([
                'status' => true,
                'message' => __('cheques.cheque_cashed_successfully') ?? 'تم تسييل الشيك وتحويله لدفعة بنجاح'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
