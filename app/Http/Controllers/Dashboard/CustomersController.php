<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Services\Dashboard\CustomerService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class CustomersController extends Controller
{
    protected $customerService, $companyService;

    public function __construct(CustomerService $customerService, CompanyService $companyService)
    {
        $this->customerService = $customerService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('customers_read');
        
        $title = __('customers.customers');
        $customers = $this->customerService->getAll($request);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.customers.partials._table', compact('customers', 'companies'))->render();
        }

        return view('dashboard.customers.index', compact('title', 'customers', 'companies'));
    }

    public function store(CustomerRequest $request)
    {
        Gate::authorize('customers_create');
        
        try {
            $customer = $this->customerService->store($request->validated());
            return response()->json([
                'status' => true, 
                'message' => __('general.add_success_message'),
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(CustomerRequest $request, string $id)
    {
        Gate::authorize('customers_update');
        
        try {
            $this->customerService->update($id, $request->validated());
            $customer = $this->customerService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message')
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        Gate::authorize('customers_delete');
        
        if ($request->ajax()) {
            try {
                $this->customerService->delete($request->id);
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

    public function changeStatus(Request $request)
    {
        Gate::authorize('customers_update');
        
        try {
            $this->customerService->changeStatus($request->id, $request->statusSwitch);
            $customer = $this->customerService->getOne($request->id);
            return response()->json([
                'status' => true, 
                'message' => __('general.change_status_success_message'),
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.change_status_error_message')
            ], 500);
        }
    }

    public function autocomplete(Request $request)
    {
        $data = $this->customerService->autocomplete($request->get('q'));
        return response()->json($data);
    }
}
