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
        $current_company_id = user()->company_id == 1 ? $this->input('company_id') : user()->company_id;
        $tenant_type = $this->input('tenant_type');

        $idNumberRule = \Illuminate\Validation\Rule::unique('customers', 'id_number')
            ->ignore($id)
            ->where('company_id', $current_company_id)
            ->whereNull('deleted_at');

        if ($tenant_type === 'company' || $tenant_type === 'individual') {
            $idNumberRule->where('tenant_type', 'individual');
        }

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_number' => ['required', 'string', 'max:255', $idNumberRule],
            'address' => 'nullable|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'tenant_type' => 'required|in:individual,company',
            'notes' => 'nullable|string',
        ];

        if ($tenant_type === 'company') {
            $rules['company_name'] = 'required|string|max:255';
            $rules['establishment_number'] = 'required|string|max:255';
            $rules['cr_number'] = [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('customers', 'cr_number')
                    ->ignore($id)
                    ->where('company_id', $current_company_id)
                    ->whereNull('deleted_at')
            ];
            $rules['license_number'] = 'required|string|max:255';
        }

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
