<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CompanyBankAccountRequest extends FormRequest
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
        $id = $this->route('bank_account'); // Matches the resource route parameter name

        $rules = [
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'account_holder_name.ar' => 'required|string|max:255',
            'account_holder_name.en' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'iban' => 'nullable|string|max:255',
            'is_default' => 'nullable', // Checkbox sends 'on' or nothing
        ];

        // If user is super admin, they must select a company
        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

}
