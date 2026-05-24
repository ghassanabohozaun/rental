<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'property_id' => 'required|exists:properties,id',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:pending,in_progress,done',
            'cost' => 'nullable|numeric|min:0',
            'items' => 'nullable|array',
            'items.*.id' => 'nullable|exists:maintenance_items,id',
            'items.*.type' => 'required|string|max:255',
            'items.*.cost' => 'nullable|numeric|min:0',
            'items.*.attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
