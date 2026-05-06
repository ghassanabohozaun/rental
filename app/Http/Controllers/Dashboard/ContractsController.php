<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContractRequest;
use App\Models\Company;
use App\Models\Property;
use App\Models\Customer;
use App\Services\Dashboard\ContractService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class ContractsController extends Controller
{
    protected $service;

    public function __construct(ContractService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        Gate::authorize('contracts_read');

        $contracts = $this->service->getAll($request);
        $title = __('contracts.contracts');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        $properties = Property::latest()->get();
        $customers = Customer::active()->latest()->get();
        $stats = $this->service->getStats();

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.contracts.partials._table', compact('contracts', 'companies', 'properties', 'customers'))->render();
        }

        return view('dashboard.contracts.index', compact('contracts', 'title', 'companies', 'properties', 'customers', 'stats'));
    }

    public function create()
    {
        Gate::authorize('contracts_create');

        $title = __('contracts.create_new_contract');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        return view('dashboard.contracts.create', compact('title', 'companies'));
    }

    public function store(ContractRequest $request)
    {
        Gate::authorize('contracts_create');

        try {
            $this->service->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function show($id)
    {
        Gate::authorize('contracts_read');

        $contract = $this->service->find($id);
        $title = __('contracts.contract_details') . ' #' . $contract->id;

        return view('dashboard.contracts.show', compact('contract', 'title'));
    }

    public function edit($id)
    {
        Gate::authorize('contracts_update');

        $title = __('contracts.update_contract');
        $contract = $this->service->find($id);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        return view('dashboard.contracts.edit', compact('contract', 'title', 'companies'));
    }

    public function update(ContractRequest $request, $id)
    {
        Gate::authorize('contracts_update');

        try {
            $this->service->update($id, $request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message')
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        Gate::authorize('contracts_delete');

        try {
            $this->service->delete($request->id);
            return response()->json([
                'status' => true,
                'message' => __('general.delete_success_message')
            ]);
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

    public function autocomplete(Request $request)
    {
        $data = $this->service->autocomplete($request->get('q'));
        return response()->json($data);
    }

    public function getPayments($id)
    {
        Gate::authorize('contracts_read');
        $contract = $this->service->find($id);
        return view('dashboard.contracts.show._payments', compact('contract'))->render();
    }

    public function getCheques($id)
    {
        Gate::authorize('contracts_read');
        $contract = $this->service->find($id);
        return view('dashboard.contracts.show._cheques', compact('contract'))->render();
    }
}
