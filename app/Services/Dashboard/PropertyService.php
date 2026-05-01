<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PropertyRepository;

class PropertyService
{
    protected $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        // Logic: The owner of the property is the company itself
        if (!isset($data['company_id'])) {
            // For regular users, use their own company
            $data['company_id'] = user()->company_id;
            $data['owner_id'] = user()->company_id;
        } else {
            // For Super Admin, use the selected company as the owner
            $data['owner_id'] = $data['company_id'];
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        // Keep owner_id synced with company_id on update
        if (isset($data['company_id'])) {
            $data['owner_id'] = $data['company_id'];
        } else {
            $data['owner_id'] = user()->company_id;
        }

        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $property = $this->repository->find($id);
        if (!$property) {
            return false;
        }

        // Check for restrictive relations (e.g., maintenances)
        $property->checkRestrictiveRelations();

        return $this->repository->delete($id);
    }

    public function autocomplete($search)
    {
        return $this->repository->autocomplete($search);
    }
}
