<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PropertyStatusRequest;
use App\Services\Dashboard\PropertyStatusService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;
class PropertyStatusesController extends Controller
{
    protected $propertyStatusService, $companyService;

    public function __construct(PropertyStatusService $propertyStatusService, CompanyService $companyService)
    {
        $this->propertyStatusService = $propertyStatusService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('property_statuses_read');

        $title = __('property_statuses.property_statuses');
        $property_statuses = $this->propertyStatusService->getAll($request);

        $companies = null;
        if (auth()->user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.property_statuses.partials._table', compact('property_statuses', 'companies'))->render();
        }

        return view('dashboard.property_statuses.index', compact('title', 'property_statuses', 'companies'));
    }

    public function store(PropertyStatusRequest $request)
    {
        Gate::authorize('property_statuses_create');

        try {
            $data = $request->only(['name', 'company_id', 'color']);
            $this->propertyStatusService->create($data);
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

    public function update(PropertyStatusRequest $request, string $id)
    {
        Gate::authorize('property_statuses_update');

        try {
            $data = $request->only(['id', 'name', 'company_id', 'color']);
            $this->propertyStatusService->update($data);
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
        Gate::authorize('property_statuses_delete');

        if ($request->ajax()) {
            try {
                $this->propertyStatusService->destroy($request->id);
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
        Gate::authorize('property_statuses_update');

        if ($request->ajax()) {
            try {
                $this->propertyStatusService->changeStatus($request->id, $request->statusSwitch);
                $status = $this->propertyStatusService->getOne($request->id);
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

    public function autocomplete(Request $request)
    {
        $data = $this->propertyStatusService->autocomplete($request->get('q'));
        return response()->json($data);
    }
}
