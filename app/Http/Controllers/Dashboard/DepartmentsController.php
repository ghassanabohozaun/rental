<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DepartmentRequest;
use App\Services\Dashboard\DepartmentService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentsController extends Controller
{
    protected $departmentService, $companyService;

    public function __construct(DepartmentService $departmentService, CompanyService $companyService)
    {
        $this->departmentService = $departmentService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('departments_read');

        $title = __('departments.departments');
        $departments = $this->departmentService->getAll($request->keyword, $request->company_id);

        $companies = null;
        if (auth()->user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.departments.partials._table', compact('departments', 'companies'))->render();
        }

        return view('dashboard.departments.index', compact('title', 'departments', 'companies'));
    }

    public function store(DepartmentRequest $request)
    {
        Gate::authorize('departments_create');

        try {
            $data = $request->only(['name', 'company_id']);
            $this->departmentService->create($data);
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(DepartmentRequest $request, string $id)
    {
        Gate::authorize('departments_update');

        try {
            $data = $request->only(['id', 'name', 'company_id']);
            $this->departmentService->update($data);
            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message')
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
        Gate::authorize('departments_delete');

        if ($request->ajax()) {
            try {
                $this->departmentService->destroy($request->id);
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

    public function changeStatus(Request $request)
    {
        Gate::authorize('departments_update');

        if ($request->ajax()) {
            try {
                $this->departmentService->changeStatus($request->id, $request->statusSwitch);
                $status = $this->departmentService->getOne($request->id);
                return response()->json([
                    'status' => true,
                    'message' => __('general.change_status_success_message'),
                    'data' => $status
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => __('general.change_status_error_message')
                ], 500);
            }
        }
    }
}
