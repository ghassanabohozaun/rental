<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyStatusRequest extends FormRequest
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
        $companyId = user()->company_id == 1 ? $this->input('company_id') : user()->company_id;

        $rules = [
            'name.*' => [
                'required', 'string', 'max:100',
                function ($attribute, $value, $fail) use ($companyId) {
                    $locale = explode('.', $attribute)[1];
                    $exists = \App\Models\PropertyStatus::where("name->{$locale}", $value)
                        ->where(function($q) use ($companyId) {
                            $q->whereNull('company_id')->orWhere('company_id', $companyId);
                        })
                        ->when($this->id, function($q) {
                            $q->where('id', '!=', $this->id);
                        })
                        ->exists();

                    if ($exists) {
                        $fail(__('validation.unique', ['attribute' => __('property_statuses.name')]));
                    }
                }
            ],
            'color' => ['nullable', 'string', 'max:20'],
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = ['nullable', 'exists:companies,id'];
        }

        return $rules;
    }
}
