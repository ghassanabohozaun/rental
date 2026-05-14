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
            ->with(['company', 'creator', 'guarantors', 'nationality'])
            ->filter($request->only(['keyword', 'company_id', 'nationality_id', 'tenant_type']), ['name', 'phone', 'email', 'id_number', 'address'], ['company_id', 'nationality_id', 'tenant_type'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->with(['company', 'guarantors', 'nationality'])->findOrFail($id);
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

    public function autocomplete($searchValue, $companyId = null)
    {
        // Prevent Super Admin from loading all customers across all companies if no company is selected
        if (user() && user()->company_id == 1 && (empty($companyId) || $companyId === 'null' || $companyId === 'undefined')) {
            return [];
        }

        $query = $this->model->query()->active();

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

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
    public function getStats()
    {
        $baseQuery = $this->model->query();

        $total_customers = $baseQuery->count();
        $active_customers = $this->model->active()->count();
        
        // Customers with at least one active contract
        $active_tenants = $this->model->whereHas('contracts', function($q) {
            $q->where('status', 'active');
        })->count();

        $corporate_customers = $this->model->where('tenant_type', 'company')->count();

        return [
            'total_customers' => $total_customers,
            'active_customers' => $active_customers,
            'active_tenants' => $active_tenants,
            'corporate_customers' => $corporate_customers,
        ];
    }
}
