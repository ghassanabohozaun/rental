<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PropertyRepository;
use App\Utils\ImageManagerUtils;
use Illuminate\Support\Arr;

class PropertyService
{
    protected $repository;
    protected $imageManager;

    public function __construct(PropertyRepository $repository, ImageManagerUtils $imageManager)
    {
        $this->repository = $repository;
        $this->imageManager = $imageManager;
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
        if (!isset($data['company_id'])) {
            // For regular users, use their own company
            $data['company_id'] = user()->company_id;
        }


        // Handle File Uploads
        $fileFields = ['rental_contract_original', 'building_completion_certificate', 'other_documents'];
        foreach ($fileFields as $field) {
            if (isset($data[$field]) && request()->hasFile($field)) {
                $data[$field] = $this->imageManager->uploadFile('', $data[$field], 'properties');
            }
        }

        $property = $this->repository->create($data);

        // Sync Owners
        $this->syncOwners($property, $data);

        return $property;
    }

    public function update($id, array $data)
    {
        $property = $this->repository->find($id);



        // Handle File Uploads & Deletions
        $fileFields = ['rental_contract_original', 'building_completion_certificate', 'other_documents'];
        
        // 1. Process explicit deletions from UI
        if (isset($data['deleted_files']) && is_array($data['deleted_files'])) {
            foreach ($data['deleted_files'] as $field) {
                if (in_array($field, $fileFields) && $property->$field) {
                    $this->imageManager->removeImageFromLocal($property->$field, 'properties');
                    $data[$field] = null;
                }
            }
        }

        // 2. Process new uploads
        foreach ($fileFields as $field) {
            if (request()->hasFile($field)) {
                // Remove old file if it exists and wasn't already cleared above
                if ($property->$field && (!array_key_exists($field, $data) || $data[$field] !== null)) {
                    $this->imageManager->removeImageFromLocal($property->$field, 'properties');
                }
                $data[$field] = $this->imageManager->uploadFile('', request()->file($field), 'properties');
            } elseif (!array_key_exists($field, $data)) {
                // Keep existing file if no new file and no deletion signal
                unset($data[$field]);
            }
        }

        // Cleanup: Remove the helper field
        unset($data['deleted_files']);

        $property = $this->repository->update($id, $data);

        // Sync Owners
        $this->syncOwners($property, $data);

        return $property;
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

    public function autocomplete($search, $companyId = null, $onlyAvailable = false, $excludeId = null)
    {
        return $this->repository->autocomplete($search, $companyId, $onlyAvailable, $excludeId);
    }

    public function getCountByStatus($statusId)
    {
        return $this->repository->getCountByStatus($statusId);
    }

    public function getTotalCount()
    {
        return $this->repository->getTotalCount();
    }

    protected function syncOwners($property, array $data)
    {
        if (isset($data['owners'])) {
            $syncData = [];
            foreach ($data['owners'] as $index => $ownerId) {
                if ($ownerId) {
                    $syncData[$ownerId] = [
                        'ownership_percentage' => $data['percentages'][$index] ?? 0,
                        'is_primary' => $data['is_primary'][$index] ?? 0,
                    ];
                }
            }
            $property->owners()->sync($syncData);
        }
    }
}
