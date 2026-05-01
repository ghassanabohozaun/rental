<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MaintenanceRequest;
use App\Services\Dashboard\MaintenanceService;
use App\Services\Dashboard\CompanyService;
use App\Services\Dashboard\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class MaintenancesController extends Controller
{
    protected $maintenanceService, $companyService, $propertyService;

    public function __construct(MaintenanceService $maintenanceService, CompanyService $companyService, PropertyService $propertyService)
    {
        $this->maintenanceService = $maintenanceService;
        $this->companyService = $companyService;
        $this->propertyService = $propertyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('maintenances_read');

        $title = __('maintenances.maintenances');
        $maintenances = $this->maintenanceService->getAll($request);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        $properties = $this->propertyService->getAll(new Request());

        if ($request->ajax()) {
            return view('dashboard.maintenances.partials._table', compact('maintenances', 'companies'))->render();
        }

        return view('dashboard.maintenances.index', compact('title', 'maintenances', 'companies', 'properties'));
    }

    public function store(MaintenanceRequest $request)
    {
        Gate::authorize('maintenances_create');

        try {
            $maintenance = $this->maintenanceService->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message'),
                'data' => $maintenance
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(MaintenanceRequest $request, string $id)
    {
        Gate::authorize('maintenances_update');

        try {
            $this->maintenanceService->update($id, $request->validated());
            $maintenance = $this->maintenanceService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $maintenance
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
        Gate::authorize('maintenances_delete');

        if ($request->ajax()) {
            try {
                $this->maintenanceService->delete($request->id);
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
        Gate::authorize('maintenances_update');

        try {
            $this->maintenanceService->changeStatus($request->id, $request->status);
            $maintenance = $this->maintenanceService->getOne($request->id);
            return response()->json([
                'status' => true,
                'message' => __('general.change_status_success_message'),
                'data' => $maintenance
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.change_status_error_message')
            ], 500);
        }
    }
}
