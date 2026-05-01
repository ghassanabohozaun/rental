<?php

namespace App\Repositories\Dashboard;

use App\Models\Customer;
use App\Traits\Dashboard\HandleAjaxPagination;

class CustomerRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator', 'guarantor'])
            ->filter($request->only(['keyword', 'company_id']), ['name', 'phone', 'email', 'id_number', 'address'], ['company_id'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $customer = $this->find($id);
        if ($customer) {
            $customer->update($data);
        }
        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->find($id);
        if ($customer) {
            return $customer->delete();
        }
        return false;
    }

    public function changeStatus($id, $status)
    {
        $customer = $this->find($id);
        if ($customer) {
            $customer->status = $status;
            $customer->save();
        }
        return $customer;
    }

    public function autocomplete($searchValue)
    {
        $query = $this->model->query()->active();

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name->en', 'like', '%' . $searchValue . '%')
                  ->orWhere('name->ar', 'like', '%' . $searchValue . '%')
                  ->orWhere('phone', 'like', '%' . $searchValue . '%')
                  ->orWhere('id_number', 'like', '%' . $searchValue . '%');
            });
        }

        return $query->orderByDesc('id')
            ->limit(10)
            ->get()
            ->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'text' => $customer->name . ' - ' . $customer->phone,
                ];
            });
    }
}
