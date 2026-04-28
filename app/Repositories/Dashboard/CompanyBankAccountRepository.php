<?php

namespace App\Repositories\Dashboard;

use App\Models\CompanyBankAccount;
use App\Traits\Dashboard\HandleAjaxPagination;

class CompanyBankAccountRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(CompanyBankAccount $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator'])
            ->when($request->company_id, function($query) use ($request) {
                return $query->where('company_id', $request->company_id);
            })
            // Filter by specific columns and translations
            ->filter($request->only(['keyword']), ['bank_name', 'account_holder_name', 'account_number', 'iban'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->with(['company', 'creator'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $account = $this->find($id);
        $account->update($data);
        return $account;
    }

    public function delete($id)
    {
        $account = $this->find($id);
        return $account->delete();
    }
}
