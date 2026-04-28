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
        // Ensure company_id is set for regular users
        if (!isset($data['company_id'])) {
            $data['company_id'] = user()->company_id;
        }

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
