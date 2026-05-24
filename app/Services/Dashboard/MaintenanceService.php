<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\MaintenanceRepository;
use App\Utils\ImageManagerUtils;

class MaintenanceService
{
    protected $repository;
    protected $imageManager;

    public function __construct(MaintenanceRepository $repository, ImageManagerUtils $imageManager)
    {
        $this->repository = $repository;
        $this->imageManager = $imageManager;
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

        if (empty($data['cost'])) {
            $data['cost'] = 0;
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        $maintenance = $this->repository->create($data);

        if (!empty($items)) {
            foreach ($items as $item) {
                if (isset($item['attachment']) && $item['attachment'] instanceof \Illuminate\Http\UploadedFile) {
                    $item['attachment'] = $this->imageManager->uploadFile('', $item['attachment'], 'maintenances');
                } else {
                    unset($item['attachment']);
                }
                $maintenance->items()->create($item);
            }
        }

        return $maintenance;
    }

    public function update($id, array $data)
    {
        if (isset($data['company_id']) && $data['company_id'] === '') {
            $data['company_id'] = null;
        }

        if (array_key_exists('cost', $data) && empty($data['cost'])) {
            $data['cost'] = 0;
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        $this->repository->update($id, $data);
        $maintenance = $this->repository->find($id);

        $existingItemIds = $maintenance->items->pluck('id')->toArray();
        $updatedItemIds = [];

        foreach ($items as $item) {
            if (isset($item['attachment']) && $item['attachment'] instanceof \Illuminate\Http\UploadedFile) {
                if (isset($item['id'])) {
                    $oldItem = $maintenance->items()->find($item['id']);
                    if ($oldItem && $oldItem->attachment) {
                        $this->imageManager->removeImageFromLocal($oldItem->attachment, 'maintenances');
                    }
                }
                $item['attachment'] = $this->imageManager->uploadFile('', $item['attachment'], 'maintenances');
            } else {
                unset($item['attachment']);
            }

            if (isset($item['id']) && in_array($item['id'], $existingItemIds)) {
                $maintenance->items()->where('id', $item['id'])->update($item);
                $updatedItemIds[] = $item['id'];
            } else {
                $maintenance->items()->create($item);
            }
        }

        $itemsToDelete = array_diff($existingItemIds, $updatedItemIds);
        if (!empty($itemsToDelete)) {
            $deletedItems = $maintenance->items()->whereIn('id', $itemsToDelete)->get();
            foreach ($deletedItems as $delItem) {
                if ($delItem->attachment) {
                    $this->imageManager->removeImageFromLocal($delItem->attachment, 'maintenances');
                }
            }
            $maintenance->items()->whereIn('id', $itemsToDelete)->delete();
        }

        return $maintenance;
    }

    public function delete($id)
    {
        $maintenance = $this->repository->find($id);
        if ($maintenance) {
            foreach ($maintenance->items as $item) {
                if ($item->attachment) {
                    $this->imageManager->removeImageFromLocal($item->attachment, 'maintenances');
                }
            }
        }
        return $this->repository->delete($id);
    }

    public function changeStatus($id, $status)
    {
        return $this->repository->changeStatus($id, $status);
    }
}
