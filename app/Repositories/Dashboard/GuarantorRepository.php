<?php

namespace App\Repositories\Dashboard;

use App\Models\Guarantor;
use App\Traits\Dashboard\HandleAjaxPagination;

class GuarantorRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Guarantor $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator'])
            ->filter($request->only(['keyword', 'company_id']), ['name', 'phone', 'id_number', 'address'], ['company_id'])
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
        $guarantor = $this->find($id);
        if ($guarantor) {
            $guarantor->update($data);
        }
        return $guarantor;
    }

    public function delete($id)
    {
        $guarantor = $this->find($id);
        if ($guarantor) {
            return $guarantor->delete();
        }
        return false;
    }

    public function changeStatus($id, $status)
    {
        $guarantor = $this->find($id);
        if ($guarantor) {
            $guarantor->status = $status;
            $guarantor->save();
        }
        return $guarantor;
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
            ->map(function ($guarantor) {
                return [
                    'id' => $guarantor->id,
                    'text' => $guarantor->name . ' - ' . $guarantor->phone,
                ];
            });
    }
}
