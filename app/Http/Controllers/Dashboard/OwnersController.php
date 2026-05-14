<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OwnerRequest;
use App\Services\Dashboard\OwnerService;
use App\Services\Dashboard\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class OwnersController extends Controller
{
    protected $ownerService, $companyService;

    public function __construct(OwnerService $ownerService, CompanyService $companyService)
    {
        $this->ownerService = $ownerService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('owners_read');

        $title = __('owners.owners');
        $owners = $this->ownerService->getAll($request);
        $companies = null;

        if (user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request());
        }

        if ($request->ajax()) {
            return view('dashboard.owners.partials._table', compact('owners', 'companies'))->render();
        }

        return view('dashboard.owners.index', compact('title', 'owners', 'companies'));
    }

    public function store(OwnerRequest $request)
    {
        Gate::authorize('owners_create');

        try {
            $owner = $this->ownerService->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message'),
                'data' => $owner
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message')
            ], 500);
        }
    }

    public function update(OwnerRequest $request, string $id)
    {
        Gate::authorize('owners_update');

        try {
            $this->ownerService->update($id, $request->validated());
            $owner = $this->ownerService->getOne($id);

            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message'),
                'data' => $owner
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
        Gate::authorize('owners_delete');

        if ($request->ajax()) {
            try {
                $this->ownerService->delete($request->id);
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

    public function autocomplete(Request $request)
    {
        $data = $this->ownerService->autocomplete($request->get('q'), $request->get('company_id'));
        return response()->json($data);
    }

    public function getByCompany(Request $request)
    {
        $owners = $this->ownerService->getByCompany($request->get('company_id'));
        return response()->json($owners);
    }
}
