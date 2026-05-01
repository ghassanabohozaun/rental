<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PropertyRequest;
use App\Models\Company;
use App\Models\PropertyType;
use App\Models\PropertyStatus;
use App\Services\Dashboard\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class PropertyController extends Controller
{
    protected $service;

    // construct
    public function __construct(PropertyService $service)
    {
        $this->service = $service;
    }

    // index
    public function index(Request $request)
    {
        Gate::authorize('properties_read');

        $properties = $this->service->getAll($request);
        $title = __('properties.properties');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        $property_types = PropertyType::active()->get();
        $property_statuses = PropertyStatus::active()->get();

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.properties.partials._table', compact('properties', 'companies'))->render();
        }

        return view('dashboard.properties.index', compact('properties', 'title', 'companies', 'property_types', 'property_statuses'));
    }

    // create
    public function create()
    {
        Gate::authorize('properties_create');

        $title = __('properties.create_new_property');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        $property_types = PropertyType::active()->get();
        $property_statuses = PropertyStatus::active()->get();

        return view('dashboard.properties.create', compact('title', 'companies', 'property_types', 'property_statuses'));
    }


    // store
    public function store(PropertyRequest $request)
    {
        Gate::authorize('properties_create');

        try {
            $this->service->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
               // 'message' => $e->getMessage()
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

        public function edit($id)
    {
        Gate::authorize('properties_update');

        $title = __('properties.update_property');
        $property = $this->service->find($id);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::where('status', 'active')->get();
        }

        $property_types = PropertyType::active()->get();
        $property_statuses = PropertyStatus::active()->get();

        return view('dashboard.properties.edit', compact('property', 'title', 'companies', 'property_types', 'property_statuses'));
    }

    // update
    public function update(PropertyRequest $request, $id)
    {
        Gate::authorize('properties_update');

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
        Gate::authorize('properties_delete');

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
}
