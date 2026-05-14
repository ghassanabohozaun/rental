<?php

namespace App\Repositories\Dashboard;

use App\Models\Property;
use App\Traits\Dashboard\HandleAjaxPagination;

class PropertyRepository
{
    use HandleAjaxPagination;

    protected $model;

    public function __construct(Property $model)
    {
        $this->model = $model;
    }

    public function getAll($request)
    {
        $query = $this->model
            ->with(['company', 'creator', 'owners', 'propertyType', 'propertyStatus'])
            ->filter(
                $request->all(),
                ['name', 'location', 'property_number', 'title_deed_number'], // Search columns
                ['property_status_id', 'company_id', 'property_type_id'], // Exact matches
                [
                    'price' => ['min' => 'price_min', 'max' => 'price_max'],
                    'area' => ['min' => 'area_min', 'max' => 'area_max']
                ] // Range filters
            )
            ->when($request->dependency_status == 'main', function ($q) {
                return $q->whereNull('parent_id');
            })
            ->when($request->dependency_status == 'sub', function ($q) {
                return $q->whereNotNull('parent_id');
            })
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->with([
            'company', 'creator', 'owners', 'propertyType', 'propertyStatus',
            'contracts.customer', 'maintenances', 'units.propertyType', 'units.propertyStatus'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $property = $this->find($id);
        $property->update($data);
        return $property;
    }

    public function delete($id)
    {
        $property = $this->find($id);
        return $property->delete();
    }

    public function autocomplete($searchValue, $companyId = null, $onlyAvailable = false, $excludeId = null)
    {
        // Prevent Super Admin from loading all properties across all companies if no company is selected
        if (user() && user()->company_id == 1 && (empty($companyId) || $companyId === 'null' || $companyId === 'undefined')) {
            return [
                'results' => [],
                'total_count' => 0
            ];
        }

        $query = $this->model->query();

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        if ($onlyAvailable) {
            $query->whereHas('propertyStatus', function ($q) {
                $q->where('name->en', 'Available');
            });
        }

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                // Merging native Laravel JSON search with standard columns
                $q->where('name->en', 'like', '%' . $searchValue . '%')
                    ->orWhere('name->ar', 'like', '%' . $searchValue . '%')
                    ->orWhere('property_number', 'like', '%' . $searchValue . '%');
            });
        }

        $totalCount = $query->count();
        $limit = empty($searchValue) ? 10 : 30;

        $results = $query->orderByDesc('id')
            ->limit($limit)
            ->get()
            ->map(function ($property) {
                return [
                    'id' => $property->id,
                    'text' => $property->name . ' (' . $property->property_number . ')',
                    'property_number' => $property->property_number,
                    'location' => $property->location
                ];
            });

        return [
            'results' => $results,
            'total_count' => $totalCount
        ];
    }

    public function getCountByStatus($statusId)
    {
        return $this->model->where('property_status_id', $statusId)->count();
    }

    public function getTotalCount()
    {
        return $this->model->count();
    }
}
