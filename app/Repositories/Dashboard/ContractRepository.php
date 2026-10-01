<?php

namespace App\Repositories\Dashboard;

use App\Models\Contract;
use App\Traits\Dashboard\HandleAjaxPagination;

class ContractRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Contract $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator', 'property', 'customer'])
            ->filter(
                $request->all(),
                [], // Search columns (could add notes or contract_text if needed, but usually search by related)
                ['property_id', 'customer_id', 'company_id', 'status', 'payment_cycle'], // Exact matches
                ['rent_amount' => ['min' => 'rent_min', 'max' => 'rent_max']] // Range filters
            )
            ->when($request->filled('company_name'), function ($q) use ($request) {
                $val = $request->company_name;
                $q->where(function ($subQ) use ($val) {
                    $subQ->whereHas('customer', function ($cq) use ($val) {
                        $cq->where('company_name', 'like', '%' . $val . '%')
                           ->orWhere('cr_number', 'like', '%' . $val . '%');
                    })->orWhereHas('contractDetail', function ($dq) use ($val) {
                        $dq->where('second_party_data', 'like', '%' . $val . '%');
                    });
                });
            })
            ->when($request->filled('electricity_account_number'), function ($q) use ($request) {
                $val = $request->electricity_account_number;
                $q->where(function ($subQ) use ($val) {
                    $subQ->whereHas('property', function ($pq) use ($val) {
                        $pq->whereAdditionalNumber('electricity_account', $val);
                    })->orWhereHas('contractDetail', function ($dq) use ($val) {
                        $dq->where('utilities_data', 'like', '%' . $val . '%');
                    });
                });
            })
            ->when($request->filled('water_account_number'), function ($q) use ($request) {
                $val = $request->water_account_number;
                $q->where(function ($subQ) use ($val) {
                    $subQ->whereHas('property', function ($pq) use ($val) {
                        $pq->whereAdditionalNumber('water_account', $val);
                    })->orWhereHas('contractDetail', function ($dq) use ($val) {
                        $dq->where('utilities_data', 'like', '%' . $val . '%');
                    });
                });
            })
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query, 20);
    }

    public function find($id)
    {
        return $this->model->with(['company', 'creator', 'property', 'customer', 'insuranceCheque', 'cheques'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $contract = $this->find($id);
        $contract->update($data);
        return $contract;
    }

    public function delete($id)
    {
        $contract = $this->find($id);
        return $contract->delete();
    }

    public function autocomplete($searchValue)
    {
        $query = $this->model->query();

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('id', 'like', '%' . $searchValue . '%')
                  ->orWhereHas('customer', function($subQ) use ($searchValue) {
                      $subQ->where('name', 'like', '%' . $searchValue . '%')
                           ->orWhere('company_name', 'like', '%' . $searchValue . '%')
                           ->orWhere('cr_number', 'like', '%' . $searchValue . '%');
                  })
                  ->orWhereHas('property', function($subQ) use ($searchValue) {
                      $subQ->where('name->ar', 'like', '%' . $searchValue . '%')
                           ->orWhere('name->en', 'like', '%' . $searchValue . '%');
                  });
            });
        }

        return $query->orderByDesc('id')
            ->limit(10)
            ->get()
            ->map(function ($contract) {
                return [
                    'id' => $contract->id,
                    'text' => $contract->display_title,
                ];
            });
    }
    public function getStats()
    {
        $baseQuery = $this->model->query();

        $total_contracts = $baseQuery->count();
        $active_contracts = $this->model->where('status', 'active')->count();
        $total_rent_value = $this->model->where('status', 'active')->sum('rent_amount');
        
        $expiring_soon = $this->model->where('status', 'active')
            ->whereBetween('end_date', [now(), now()->addDays(30)])
            ->count();

        return [
            'total_contracts' => $total_contracts,
            'active_contracts' => $active_contracts,
            'total_rent_value' => $total_rent_value,
            'expiring_soon' => $expiring_soon,
        ];
    }
}
