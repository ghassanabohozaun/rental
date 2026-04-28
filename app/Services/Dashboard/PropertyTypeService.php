<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PropertyTypeRepository;

class PropertyTypeService
{
    protected $repository;

    public function __construct(PropertyTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function getActiveAll()
    {
        return $this->repository->getActiveAll();
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($data)
    {
        $propertyType = $this->getOne($data['id']);
        return $this->repository->update($propertyType, $data);
    }

    public function destroy($id)
    {
        $propertyType = $this->getOne($id);
        return $this->repository->destroy($propertyType);
    }

    public function changeStatus($id, $status)
    {
        $propertyType = $this->getOne($id);
        return $this->repository->changeStatus($propertyType, $status);
    }

    public function autocomplete($searchValue)
    {
        return $this->repository->autocomplete($searchValue);
    }
}
