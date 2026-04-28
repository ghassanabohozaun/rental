<?php

namespace App\Repositories\Dashboard;

use App\Models\Company;
use App\Traits\Dashboard\HandleAjaxPagination;
class CompanyRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with('creator')
            ->when($request->company_id, function($query) use ($request) {
                return $query->where('id', $request->company_id);
            })
            ->filter($request->only(['keyword']), ['name', 'email', 'phone'])
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
        $company = $this->find($id);
        $company->update($data);
        return $company;
    }

    public function delete($id)
    {
        $company = $this->find($id);
        return $company->delete();
    }

    public function updateStatus($id, $status)
    {
        $company = $this->find($id);
        $company->status = $status;
        $company->save();
        return $company;
    }

    public function autocomplete($searchValue)
    {
        $query = $this->model->query()->where('status', 'active');

        if (!empty($searchValue)) {
            $searchTerm = mb_strtolower($searchValue, 'UTF-8');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name->"$.en") like ?', ['"%' . $searchTerm . '%"'])
                  ->orWhereRaw('LOWER(name->"$.ar") like ?', ['"%' . $searchTerm . '%"']);
            });
        }

        return $query->orderByDesc('id')
            ->limit(10)
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'text' => $company->name,
                ];
            });
    }
}
