<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GuarantorRequest;
use App\Services\Dashboard\GuarantorService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;
class GuarantorsController extends Controller
{
    protected $guarantorService, $companyService;

    public function __construct(GuarantorService $guarantorService, CompanyService $companyService)
    {
        $this->guarantorService = $guarantorService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('guarantors_read');

        $title = __('guarantors.guarantors');
        $guarantors = $this->guarantorService->getAll($request);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.guarantors.partials._table', compact('guarantors', 'companies'))->render();
        }

        return view('dashboard.guarantors.index', compact('title', 'guarantors', 'companies'));
    }

    public function store(GuarantorRequest $request)
    {
        Gate::authorize('guarantors_create');

        try {
            $guarantor = $this->guarantorService->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message'),
                'data' => $guarantor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(GuarantorRequest $request, string $id)
    {
        Gate::authorize('guarantors_update');

        try {
            $this->guarantorService->update($id, $request->validated());
            $guarantor = $this->guarantorService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $guarantor
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
        Gate::authorize('guarantors_delete');

        if ($request->ajax()) {
            try {
                $this->guarantorService->delete($request->id);
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
        Gate::authorize('guarantors_update');

        try {
            $this->guarantorService->changeStatus($request->id, $request->statusSwitch);
            $guarantor = $this->guarantorService->getOne($request->id);
            return response()->json([
                'status' => true,
                'message' => __('general.change_status_success_message'),
                'data' => $guarantor
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.change_status_error_message')
            ], 500);
        }
    }

    public function autocomplete(Request $request)
    {
        $data = $this->guarantorService->autocomplete($request->get('q'));
        return response()->json($data);
    }
}
