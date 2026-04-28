<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PropertyStatusRepository;

class PropertyStatusService
{
    protected $propertyStatusRepository;

    // constructor
    public function __construct(PropertyStatusRepository $propertyStatusRepository)
    {
        $this->propertyStatusRepository = $propertyStatusRepository;
    }

    // get one
    public function getOne($id)
    {
        return $this->propertyStatusRepository->getOne($id);
    }

    // get all
    public function getAll($request)
    {
        return $this->propertyStatusRepository->getAll($request);
    }

    // get active all
    public function getActiveAll()
    {
        return $this->propertyStatusRepository->getActiveAll();
    }

    // create
    public function create($data)
    {
        $propertyStatus = $this->propertyStatusRepository->create($data);
        if (!$propertyStatus) {
            return false;
        }
        return $propertyStatus;
    }

    // update
    public function update($data)
    {
        $propertyStatus = self::getOne($data['id']);

        if (!$propertyStatus) {
            return false;
        }

        $propertyStatus = $this->propertyStatusRepository->update($propertyStatus, $data);
        if (!$propertyStatus) {
            return false;
        }
        return $propertyStatus;
    }

    // destroy
    public function destroy($id)
    {
        $propertyStatus = $this->getOne($id);

        if (!$propertyStatus) {
            return false;
        }

        $propertyStatus = $this->propertyStatusRepository->destroy($propertyStatus);
        if (!$propertyStatus) {
            return false;
        }
        return $propertyStatus;
    }

    // change status
    public function changeStatus($id, $status)
    {
        $propertyStatus = self::getOne($id);
        if (!$propertyStatus) {
            return false;
        }
        $propertyStatus = $this->propertyStatusRepository->changeStatus($propertyStatus, $status);
        if (!$propertyStatus) {
            return false;
        }
        return $propertyStatus;
    }

    public function autocomplete($searchValue)
    {
        return $this->propertyStatusRepository->autocomplete($searchValue);
    }
}
