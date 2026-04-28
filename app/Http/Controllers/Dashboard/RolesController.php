<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Services\Dashboard\CompanyService;

class RolesController extends Controller
{
    protected $roleService, $companyService;

    public function __construct(RoleService $roleService, CompanyService $companyService)
    {
        $this->roleService = $roleService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        Gate::authorize('roles_read');

        $title = __('roles.roles');
        $roles = $this->roleService->getRoles($request);

        $companies = null;
        if (auth()->user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        if ($request->ajax()) {
            return view('dashboard.roles.partials._table', compact('roles', 'companies'))->render();
        }
        return view('dashboard.roles.index', compact('title', 'roles', 'companies'));
    }

    public function create()
    {
        Gate::authorize('roles_create');

        $title = __('roles.create_new_role');

        $companies = null;
        if (auth()->user()->company_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        return view('dashboard.roles.create', compact('title', 'companies'));
    }

    public function store(RoleRequest $request)
    {
        Gate::authorize('roles_create');

        try {
            $this->roleService->storeRole($request);

            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => __('general.add_success_message')], 201);
            }

            flash()->success(__('general.add_success_message'));
            return redirect()->route('dashboard.roles.index');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => __('general.add_error_message')], 500);
            }
            flash()->error(__('general.add_error_message'));
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        Gate::authorize('roles_update');

        $title = __('roles.update_role');
        $role = $this->roleService->getRole($id);

        if (!$role) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.roles.index');
        }

        $this->authorize('update', $role);

        $companies = null;
        if (auth()->user()->company_id == 1 || auth()->user()->role_id == 1) {
            $companies = $this->companyService->getAll(new Request())->where('id', '!=', 1);
        }

        return view('dashboard.roles.edit', compact('role', 'title', 'companies'));
    }

    public function update(RoleRequest $request, string $id)
    {
        $role = $this->roleService->getRole($id);
        if ($role) {
            $this->authorize('update', $role);
        }

        try {
            $this->roleService->updateRole($request, $id);

            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => __('general.update_success_message')], 200);
            }

            flash()->success(__('general.update_success_message'));
            return redirect()->route('dashboard.roles.index');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => __('general.update_error_message')], 500);
            }
            flash()->error(__('general.update_error_message'));
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $role = $this->roleService->getRole($request->id);
        if ($role) {
            $this->authorize('delete', $role);
        }

        if ($request->ajax()) {
            try {
                $this->roleService->destroyRole($request->id);
                return response()->json(['status' => true, 'message' => __('general.delete_success_message')], 200);
            } catch (\App\Exceptions\DeleteRestrictionException $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => __('general.delete_error_message')], 500);
            }
        }
    }
}
