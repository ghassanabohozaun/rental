<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CompanyRequest;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompaniesController extends Controller
{
    protected $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        Gate::authorize('companies_read');
        abort_if(user()->company_id != 1, 403);
        
        $companies = $this->service->getAll($request);
        $title = __('companies.companies');

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.companies.partials._table', compact('companies'))->render();
        }

        return view('dashboard.companies.index', compact('companies', 'title'));
    }

    public function store(CompanyRequest $request)
    {
        Gate::authorize('companies_create');
        abort_if(user()->company_id != 1, 403);
        
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

    public function update(CompanyRequest $request, $id)
    {
        Gate::authorize('companies_update');
        abort_if(user()->company_id != 1, 403);
        
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
        Gate::authorize('companies_delete');
        abort_if(user()->company_id != 1, 403);
        
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

    public function updateStatus(Request $request)
    {
        Gate::authorize('companies_update');
        abort_if(user()->company_id != 1, 403);
        
        try {
            $this->service->updateStatus($request->id, $request->statusSwitch);
            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => ['id' => $request->id, 'status' => $request->statusSwitch]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message')
            ], 500);
        }
    }

    public function autocomplete(Request $request)
    {
        $data = $this->service->autocomplete($request->get('q'));
        return response()->json($data);
    }
}
