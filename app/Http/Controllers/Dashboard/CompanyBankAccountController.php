<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CompanyBankAccountRequest;
use App\Models\Company;
use App\Services\Dashboard\CompanyBankAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyBankAccountController extends Controller
{
    protected $service;

    public function __construct(CompanyBankAccountService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        Gate::authorize('bank_accounts_read'); 

        $bankAccounts = $this->service->getAll($request);
        $title = __('bank_accounts.bank_accounts');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.bank_accounts.partials._table', compact('bankAccounts', 'companies'))->render();
        }

        return view('dashboard.bank_accounts.index', compact('bankAccounts', 'title', 'companies'));
    }

    public function store(CompanyBankAccountRequest $request)
    {
        Gate::authorize('bank_accounts_create');
        
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

    public function update(CompanyBankAccountRequest $request, $id)
    {
        Gate::authorize('bank_accounts_update');
        
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
        Gate::authorize('bank_accounts_delete');
        
        try {
            $this->service->delete($request->id);
            return response()->json([
                'status' => true,
                'message' => __('general.delete_success_message')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.delete_error_message')
            ], 500);
        }
    }
}
