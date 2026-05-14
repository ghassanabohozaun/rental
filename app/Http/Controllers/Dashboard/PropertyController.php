<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PropertyRequest;
use App\Models\Property;
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

        // Calculate counts for stats cards
        $total_count = $this->service->getTotalCount();
        $available_count = $this->service->getCountByStatus(1); // Available
        $rented_count = $this->service->getCountByStatus(2);    // Rented
        $maintenance_count = $this->service->getCountByStatus(4); // Maintenance

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.properties.partials._table', compact('properties', 'companies'))->render();
        }

        return view('dashboard.properties.index', compact(
            'properties', 'title', 'companies', 'property_types',
            'property_statuses', 'total_count', 'available_count', 'rented_count', 'maintenance_count'
        ));
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

        // Initial owners list (filtered by company if user is not admin)
        $owner_query = \App\Models\Owner::active();
        if (user()->company_id != 1) {
            $owner_query->where('company_id', user()->company_id);
        }
        $owners = $owner_query->get();

        // Get properties that can be parents (usually those without a parent)
        $parent_properties = Property::whereNull('parent_id')->get();

        return view('dashboard.properties.create_livewire', compact('title'));
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
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    // show
    public function show($id)
    {
        Gate::authorize('properties_read');

        $property = $this->service->find($id);
        $title = __('properties.property_details') . ' - ' . $property->name;

        return view('dashboard.properties.show', compact('property', 'title'));
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

        // Owners filtered by current property company
        $owners = \App\Models\Owner::active()
            ->where('company_id', $property->company_id)
            ->get();

        // Get properties that can be parents (excluding the current one and its children)
        $parent_properties = Property::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        return view('dashboard.properties.edit_livewire', compact('property', 'title'));
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
        $data = $this->service->autocomplete(
            $request->get('q'),
            $request->get('company_id'),
            $request->get('only_available', false),
            $request->get('exclude_id')
        );
        return response()->json($data);
    }
}
