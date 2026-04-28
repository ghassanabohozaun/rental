<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CompanyBankAccountRepository;

class CompanyBankAccountService
{
    protected $repository;

    public function __construct(CompanyBankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function store(array $data)
    {
        // Handle is_default logic (Checkbox sends 'on' or is missing)
        $data['is_default'] = isset($data['is_default']) && $data['is_default'] === 'on' ? 1 : 0;
        
        // Ensure company_id is set for regular users
        if (!isset($data['company_id'])) {
            $data['company_id'] = user()->company_id;
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        // Handle is_default logic
        $data['is_default'] = isset($data['is_default']) && $data['is_default'] === 'on' ? 1 : 0;
        
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
