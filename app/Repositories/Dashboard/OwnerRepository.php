<?php

namespace App\Repositories\Dashboard;

use App\Models\Owner;
use App\Traits\Dashboard\HandleAjaxPagination;

class OwnerRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Owner $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator'])
            ->filter($request->only(['keyword', 'company_id']), ['name', 'phone', 'identification_number', 'address', 'type'], ['company_id'])
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
        $owner = $this->find($id);
        if ($owner) {
            $owner->update($data);
        }
        return $owner;
    }

    public function delete($id)
    {
        $owner = $this->find($id);
        if ($owner) {
            return $owner->delete();
        }
        return false;
    }

    public function autocomplete($searchValue, $companyId = null)
    {
        $query = $this->model->query()->active();

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name->en', 'like', '%' . $searchValue . '%')
                    ->orWhere('name->ar', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('identification_number', 'like', '%' . $searchValue . '%');
            });
        }

        $totalCount = $query->count();

        $results = $query->orderByDesc('id')
            ->limit(30)
            ->get()
            ->map(function ($owner) {
                return [
                    'id' => $owner->id,
                    'text' => $owner->name . ' - ' . $owner->phone,
                ];
            });

        return [
            'results' => $results,
            'total_count' => $totalCount
        ];
    }

    public function getByCompany($companyId)
    {
        $query = $this->model->query()->active();
        
        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        return $query->orderByDesc('id')
            ->get()
            ->map(function ($owner) {
                return [
                    'id' => $owner->id,
                    'name' => $owner->getTranslation('name', app()->getLocale()),
                ];
            });
    }
}
