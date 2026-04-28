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
            ->with(['company', 'creator', 'owner', 'propertyType', 'propertyStatus'])
            ->filter(
                $request->all(),
                ['name', 'location', 'property_number', 'title_deed_number'], // Search columns
                ['property_status_id', 'company_id', 'property_type_id'], // Exact matches
                ['price' => ['min' => 'price_min', 'max' => 'price_max']] // Range filters
            )
            ->orderByDesc('id');

        return $this->applyAjaxPagination($request, $query);
    }

    public function find($id)
    {
        return $this->model->with(['company', 'creator', 'owner'])->findOrFail($id);
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
}
