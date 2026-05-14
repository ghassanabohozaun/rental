<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $company_id = user()->company_id == 1 ? $this->company_id : user()->company_id;

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
            'owners' => 'required|array|min:1',
            'owners.*' => 'required|exists:owners,id|distinct',
            'percentages' => 'required|array',
            'percentages.*' => 'required|numeric|min:0|max:100',
            'is_primary' => 'required|array',
            'parent_id' => 'nullable|exists:properties,id',
            'file_number' => ['nullable', 'string', 'max:255', Rule::unique('properties', 'file_number')->where('company_id', $company_id)->ignore($this->property)],
            'rental_contract_original' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'building_completion_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'other_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'deleted_files' => 'nullable|array',
            'deleted_files.*' => 'string|in:rental_contract_original,building_completion_certificate,other_documents',
            'deleted_files' => 'nullable|array',
            'deleted_files.*' => 'string|in:rental_contract_original,building_completion_certificate,other_documents',
        ];

        // If user is super admin, they must select a company
        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'owners.*.distinct' => __('properties.duplicate_owner_error'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'owners.*' => __('properties.owner'),
            'percentages.*' => __('properties.percentage'),
            'owners' => __('properties.owners'),
            'percentages' => __('properties.percentages'),
            'is_primary' => __('properties.is_primary'),
        ];
    }
}
