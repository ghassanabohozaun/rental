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
        $isSuper = user()->company_id == 1;

        return [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'id_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'company_id' => $isSuper ? 'required|exists:companies,id' : 'nullable|exists:companies,id',
        ];
    }
}
