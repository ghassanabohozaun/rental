<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyTypeRequest extends FormRequest
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
            'name.*' => ['required', 'string', 'max:100', UniqueTranslationRule::for('property_types')->ignore($this->id)],
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = ['required', 'exists:companies,id'];
        }

        return $rules;
    }
}
