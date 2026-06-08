<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContractClauseTemplateRequest;
use App\Models\Company;
use App\Models\ContractClauseTemplate;
use App\Services\Dashboard\ContractClauseTemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContractClauseTemplateController extends Controller
{
    protected $contractClauseTemplateService;

    public function __construct(ContractClauseTemplateService $contractClauseTemplateService)
    {
        $this->contractClauseTemplateService = $contractClauseTemplateService;

        // Define middleware for permissions (assuming standard permissions setup)
        // $this->middleware('permission:contracts_create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:contracts_update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:contracts_delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        Gate::authorize('contract_clauses_read');

        $title = __('contracts.contract_clauses_library');
        $companies = auth()->user()->role_id == 1 ? Company::active()->orderBy('id', 'desc')->get() : [];

        if ($request->ajax() || $request->has('_ajax')) {
            $templates = $this->contractClauseTemplateService->getClauseTemplates($request)->paginate(15);
            return view('dashboard.contract_clause_templates.partials._table', compact('templates'))->render();
        }

        $templates = $this->contractClauseTemplateService->getClauseTemplates($request)->paginate(15);

        return view('dashboard.contract_clause_templates.index', compact('title', 'companies', 'templates'));
    }

    public function create()
    {
        Gate::authorize('contract_clauses_create');

        $title = __('contracts.add_new_clause');
        $companies = auth()->user()->role_id == 1 ? Company::active()->orderBy('id', 'desc')->get() : [];

        return view('dashboard.contract_clause_templates.create', compact('title', 'companies'));
    }

    public function store(ContractClauseTemplateRequest $request)
    {
        Gate::authorize('contract_clauses_create');

        try {
            $this->contractClauseTemplateService->store($request->validated());

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

    public function edit($id)
    {
        Gate::authorize('contract_clauses_update');

        $template = ContractClauseTemplate::findOrFail($id);

        // Ensure user can only edit their company's templates
        if (auth()->user()->role_id != 1 && $template->company_id != auth()->user()->company_id) {
            abort(403);
        }

        $title = __('contracts.edit_clause');
        $companies = auth()->user()->role_id == 1 ? Company::active()->orderBy('id', 'desc')->get() : [];

        return view('dashboard.contract_clause_templates.edit', compact('template', 'title', 'companies'));
    }

    public function update(ContractClauseTemplateRequest $request, $id)
    {
        Gate::authorize('contract_clauses_update');

        try {
            $template = ContractClauseTemplate::findOrFail($id);

            if (auth()->user()->role_id != 1 && $template->company_id != auth()->user()->company_id) {
                abort(403);
            }

            $this->contractClauseTemplateService->update($template, $request->validated());

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

    public function destroy($id)
    {
        Gate::authorize('contract_clauses_delete');

        try {
            $template = ContractClauseTemplate::findOrFail($id);

            if (auth()->user()->role_id != 1 && $template->company_id != auth()->user()->company_id) {
                abort(403);
            }

            $this->contractClauseTemplateService->destroy($template);

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

    // API for fetching clauses when building a contract
    public function getCompanyClauses(Request $request)
    {
        $companyId = $request->company_id ?? auth()->user()->company_id;

        $clauses = ContractClauseTemplate::active()->where('company_id', $companyId)->orderBy('order_num', 'asc')->orderBy('id', 'desc')->get();

        return response()->json($clauses);
    }
}
