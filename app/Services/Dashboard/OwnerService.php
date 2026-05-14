<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\OwnerRepository;

class OwnerService
{
    protected $repository;

    public function __construct(OwnerRepository $repository)
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
        $owner = $this->repository->find($id);
        if (!$owner) {
            return false;
        }

        // Check for restrictive relations (to be added in Owner model if needed)
        if (method_exists($owner, 'checkRestrictiveRelations')) {
            $owner->checkRestrictiveRelations();
        }

        return $this->repository->delete($id);
    }

    public function autocomplete($searchValue, $companyId = null)
    {
        return $this->repository->autocomplete($searchValue, $companyId);
    }

    public function getByCompany($companyId)
    {
        return $this->repository->getByCompany($companyId);
    }
}
