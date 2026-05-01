<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CustomerRepository;

class CustomerService
{
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function getOne($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        if (!isset($data['created_by'])) {
            $data['created_by'] = auth()->id();
        }
        
        if (!isset($data['company_id']) && user()->company_id != 1) {
            $data['company_id'] = user()->company_id;
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['company_id']) && $data['company_id'] === '') {
            $data['company_id'] = null;
        }

        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function changeStatus($id, $status)
    {
        return $this->repository->changeStatus($id, $status);
    }

    public function autocomplete($searchValue)
    {
        return $this->repository->autocomplete($searchValue);
    }
}
