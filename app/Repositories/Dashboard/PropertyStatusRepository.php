<?php

namespace App\Repositories\Dashboard;

use App\Models\PropertyStatus;
use App\Traits\Dashboard\HandleAjaxPagination;

class PropertyStatusRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(PropertyStatus $model)
    {
        $this->model = $model;
    }

    // get one
    public function getOne($id)
    {
        return $this->model->find($id);
    }

    // get all
    public function getAll($request)
    {
        $query = $this->model->with(['company', 'creator'])
            ->filter($request->only(['keyword', 'company_id']), ['name'], ['company_id'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    // get active all
    public function getActiveAll()
    {
        return $this->model->active()
            ->get();
    }

    // create
    public function create($data)
    {
        if (isset($data['company_id']) && $data['company_id'] === '') {
            $data['company_id'] = null;
        }
        return $this->model->create($data);
    }

    // update
    public function update($propertyStatus, $data)
    {
        if (isset($data['company_id']) && $data['company_id'] === '') {
            $data['company_id'] = null;
        }
        return $propertyStatus->update($data);
    }

    // destroy
    public function destroy($propertyStatus)
    {
        return $propertyStatus->forceDelete();
    }

    // change status
    public function changeStatus($propertyStatus, $status)
    {
        return $propertyStatus->update([
            'status' => $status,
        ]);
    }

    public function autocomplete($searchValue)
    {
        $query = $this->model->query()->active();

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name->en', 'like', '%' . $searchValue . '%')
                  ->orWhere('name->ar', 'like', '%' . $searchValue . '%');
            });
        }

        return $query->orderByDesc('id')
            ->limit(10)
            ->get()
            ->map(function ($status) {
                return [
                    'id' => $status->id,
                    'text' => $status->name,
                ];
            });
    }
}
