<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PropertyTypeRequest;
use App\Services\Dashboard\PropertyTypeService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class PropertyTypesController extends Controller
{
    protected $propertyTypeService, $companyService;

    public function __construct(PropertyTypeService $propertyTypeService, CompanyService $companyService)
    {
        $this->propertyTypeService = $propertyTypeService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('property_types_read');

        $title = __('property_types.property_types');
        $property_types = $this->propertyTypeService->getAll($request);

        $companies = null;
        if (auth()->user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.property_types.partials._table', compact('property_types', 'companies'))->render();
        }

        return view('dashboard.property_types.index', compact('title', 'property_types', 'companies'));
    }

    public function store(PropertyTypeRequest $request)
    {
        Gate::authorize('property_types_create');

        try {
            $data = $request->only(['name', 'company_id']);
            $this->propertyTypeService->create($data);
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

    public function update(PropertyTypeRequest $request, string $id)
    {
        Gate::authorize('property_types_update');

        try {
            $data = $request->only(['id', 'name', 'company_id']);
            $this->propertyTypeService->update($data);
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
        Gate::authorize('property_types_delete');

        if ($request->ajax()) {
            try {
                $this->propertyTypeService->destroy($request->id);
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
        Gate::authorize('property_types_update');

        if ($request->ajax()) {
            try {
                $this->propertyTypeService->changeStatus($request->id, $request->statusSwitch);
                $status = $this->propertyTypeService->getOne($request->id);
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
        $data = $this->propertyTypeService->autocomplete($request->get('q'));
        return response()->json($data);
    }
}
