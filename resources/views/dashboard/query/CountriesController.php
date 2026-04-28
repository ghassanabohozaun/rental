<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountryRequest;
use App\Services\Dashboard\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    protected $countryService;

    // __construct
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    // index
    public function index(Request $request)
    {
        $title = __('addresses.countries');
        $filters = $request->all();
        $countries = $this->countryService->getCountries($filters);

        if ($request->ajax()) {
            return view('dashboard.addresses.countries.partials._table', compact('countries'))->render();
        }

        return view('dashboard.addresses.countries.index', compact('title', 'countries'));
    }

    // get cities by country id
    public function getAllCitiesByCountry($country_id)
    {
        $title = __('addresses.cities');
        $cities = $this->countryService->getAllCitiesByCountry($country_id);
        return view('dashboard.addresses.cities.index', compact('title', 'cities'));
    }

    // create
    public function create()
    {
        $title = __('addresses.create_new_country');
        return view('dashboard.addresses.countries.create', compact('title'));
    }

    // store
    public function store(CountryRequest $request)
    {
        $data = $request->only(['name', 'phone_code', 'flag_code', 'status']);
        $country = $this->countryService->storeCountry($data);
        if (!$country) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $country], 200);
    }

    //show
    public function show(string $id)
    {
        //
    }

    //edit
    public function edit(string $id)
    {
        $title = __('addresses.update_country');
        $country = $this->countryService->getCountry($id);
        if (!$country) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }
        return view('dashboard.addresses.countries.edit', compact('title', 'country'));
    }

    // update
    public function update(CountryRequest $request, string $id)
    {
        $country = $this->countryService->getCountry($id);
        if (!$country) {
            flash()->error(__('general.no_record_found'));
            return redirect()->back();
        }

        $data = $request->only(['name', 'phone_code', 'flag_code', 'status']);
        $country = $this->countryService->updateCountry($data, $id);
        if (!$country) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $country], 200);
    }

    // destroy
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->countryService->destroyCountry($request->id);
                if ($status === 'success') {
                    return response()->json(['status' => true], 200);
                } elseif ($status === 'restricted') {
                    return response()->json(['status' => false, 'message' => __('addresses.country_restricted_deletion')], 422);
                } elseif ($status === 'not_found') {
                    return response()->json(['status' => false, 'message' => __('general.no_record_found')], 404);
                }
                return response()->json(['status' => false, 'message' => __('general.error')], 500);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
        }
    }

   // country change status
    public function changeStatus(Request $request)
    {
        $country = $this->countryService->changeStatusCountry($request->id, $request->statusSwitch);

        if (!$country) {
            return response()->json(['status' => false], 500);
        }
        $country = $this->countryService->getCountry($request->id);
        return response()->json(['status' => true, 'data' => $country], 200);
    }


    // autocomplete Country
    public function autocompleteCountry(Request $request)
    {
        $data = $this->countryService->autocompleteCountry($request->get('q'));
        return response()->json($data);
    }
}
