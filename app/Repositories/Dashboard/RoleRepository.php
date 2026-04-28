<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;
use App\Models\Permission;
use App\Traits\Dashboard\HandleAjaxPagination;

class RoleRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get a specific role by ID.
     */
    public function getRole($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get roles for the current company (with filter - for roles index page).
     */
    public function getRoles($request)
    {
        $query = $this->model->with(['company', 'creator'])
            ->filter($request->only(['keyword', 'company_id']), ['name'], ['company_id'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    /**
     * Get ALL roles for the current company (no filter - for dropdowns).
     */
    public function getAllRoles()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Store a new role.
     */
    public function storeRole($request)
    {
        $role = $this->model->create([
            'company_id' => $request->filled('company_id') ? $request->company_id : null,
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'description' => $request->description,
        ]);

        if ($request->has('permissions')) {
            $permissionIds = Permission::whereIn('name', $request->permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        return $role;
    }

    /**
     * Update an existing role.
     */
    public function updateRole($request, $role)
    {
        $data = [
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'description' => $request->description,
        ];

        // Only update company_id if the user is a super admin (sent in request)
        if ($request->has('company_id')) {
            $data['company_id'] = $request->filled('company_id') ? $request->company_id : null;
        }

        $role->update($data);

        if ($request->has('permissions')) {
            $permissionIds = Permission::whereIn('name', $request->permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        return $role;
    }

    /**
     * Delete a role.
     */
    public function destroyRole($role)
    {
        return $role->delete();
    }
}
