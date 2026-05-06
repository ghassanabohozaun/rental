<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GuarantorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('guarantor');

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'id_number' => 'required|string|max:255|unique:guarantors,id_number,' . ($id ? $id : 'NULL') . ',id,deleted_at,NULL',
            'address' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
