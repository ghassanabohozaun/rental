<?php

namespace App\Repositories\Dashboard;

use App\Models\Maintenance;
use App\Traits\Dashboard\HandleAjaxPagination;

class MaintenanceRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Maintenance $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator', 'property'])
            ->filter($request->only(['keyword', 'company_id', 'property_id', 'status']), ['description', 'cost', 'date'], ['company_id', 'property_id', 'status'])
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        $data['description'] = [
            'en' => $data['description_en'] ?? null,
            'ar' => $data['description_ar'] ?? null,
        ];
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $maintenance = $this->find($id);
        if ($maintenance) {
            if (isset($data['description_en']) || isset($data['description_ar'])) {
                $data['description'] = [
                    'en' => $data['description_en'] ?? $maintenance->getTranslation('description', 'en'),
                    'ar' => $data['description_ar'] ?? $maintenance->getTranslation('description', 'ar'),
                ];
            }
            $maintenance->update($data);
        }
        return $maintenance;
    }

    public function delete($id)
    {
        $maintenance = $this->find($id);
        if ($maintenance) {
            return $maintenance->delete();
        }
        return false;
    }

    public function changeStatus($id, $status)
    {
        $maintenance = $this->find($id);
        if ($maintenance) {
            $maintenance->status = $status;
            $maintenance->save();
        }
        return $maintenance;
    }
}
