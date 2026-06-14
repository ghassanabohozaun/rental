<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $companyId = user()->company_id == 1 ? $this->input('company_id') : user()->company_id;

        $rules = [
            'bank_name.ar' => 'required|string|max:255',
            'bank_name.en' => 'required|string|max:255',
            'account_holder_name.ar' => 'required|string|max:255',
            'account_holder_name.en' => 'required|string|max:255',
            'account_number' => [
                'required',
                'digits:13',
                function ($attribute, $value, $fail) use ($id, $companyId) {
                    $bankNameAr = $this->input('bank_name.ar');
                    $bankNameEn = $this->input('bank_name.en');

                    $exists = \DB::table('company_bank_accounts')
                        ->where('company_id', $companyId)
                        ->where('account_number', $value)
                        ->where(function ($query) use ($bankNameAr, $bankNameEn) {
                            $query->where('bank_name->ar', $bankNameAr)
                                  ->orWhere('bank_name->en', $bankNameEn);
                        })
                        ->whereNull('deleted_at')
                        ->when($id, function ($query) use ($id) {
                            $query->where('id', '!=', $id);
                        })
                        ->exists();

                    if ($exists) {
                        $fail(__('validation.unique_bank_account'));
                    }
                }
            ],
            'iban' => ['nullable', 'string', 'max:255', Rule::unique('company_bank_accounts', 'iban')->ignore($id)->whereNull('deleted_at')],
            'is_default' => 'nullable', // Checkbox sends 'on' or nothing
        ];

        // If user is super admin, they must select a company
        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }

}
