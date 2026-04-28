<?php

namespace App\Repositories\Dashboard;

use App\Models\User;
use App\Traits\Dashboard\HandleAjaxPagination;

class UserRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    // get user by id
    public function getUser($id)
    {
        return $this->model->find($id);
    }

    // get all users by current country
    public function getUsers($request)
    {
        $query = $this->model
            ->with(['creator', 'role'])
            ->filter($request->only(['keyword', 'company_id']), ['name', 'email'], ['company_id'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    // store user
    public function storeUser($data)
    {
        return $this->model->create([
            'company_id' => $data['company_id'] ?? null,
            'role_id' => $data['role_id'],
            'name' => [
                'ar' => $data['name']['ar'],
                'en' => $data['name']['en'],
            ],
            'email' => $data['email'],
            'password' => $data['password'],
            'mobile' => $data['mobile'] ?? null,
            'status' => 1,
            'photo' => $data['photo'] ?? null,
        ]);
    }

    // update user
    public function updateUser($data, $user)
    {
        return $user->update([
            'company_id' => $data['company_id'] ?? $user->company_id,
            'role_id' => $data['role_id'],
            'name' => [
                'ar' => $data['name']['ar'],
                'en' => $data['name']['en'],
            ],
            'email' => $data['email'],
            'password' => empty($data['password']) ? $user->password : $data['password'],
            'mobile' => $data['mobile'] ?? $user->mobile,
            'photo' => $data['photo'] ?? $user->photo,
        ]);
    }

    // delete user
    public function destroyUser($user)
    {
        return $user->delete();
    }

    // change user status
    public function changeStatusUser($user, $status)
    {
        return $user->update(['status' => $status]);
    }
}
