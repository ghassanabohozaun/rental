<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'area' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0|max:999999999999',
            'property_status_id' => 'required|exists:property_statuses,id',
            'description' => 'nullable|string',
            'property_number' => 'required|string|max:255',
            'title_deed_number' => 'required|string|max:255',
            'electricity_account_number' => 'required|string|max:255',
            'water_account_number' => 'required|string|max:255',
            'owner_id' => 'nullable|exists:users,id',
        ];

        // If user is super admin, they must select a company
        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
