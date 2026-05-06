<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('customer');

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'id_number' => 'required|string|max:255|unique:customers,id_number,' . ($id ? $id : 'NULL') . ',id,deleted_at,NULL',
            'address' => 'required|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'tenant_type' => 'required|in:individual,company',
            'guarantor_id' => 'required|exists:guarantors,id',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
