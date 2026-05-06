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
            $query->where(function ($q) use ($searchValue) {
                $q->where('name->en', 'like', '%' . $searchValue . '%')
                  ->orWhere('name->ar', 'like', '%' . $searchValue . '%');
            });
        }

        $limit = empty($searchValue) ? 5 : 30;
        $paginator = $query->orderByDesc('id')->paginate($limit);

        $results = $paginator->map(function ($company) {
            return [
                'id'       => $company->id,
                'text'     => $company->name,
            ];
        });

        return [
            'results' => $results,
            'total_count' => $paginator->total()
        ];
    }
}
