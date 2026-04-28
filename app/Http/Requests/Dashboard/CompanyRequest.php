<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('company') ?? $this->id;
        
        return [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'subscription_plan' => 'required|string',
            'status' => 'required|in:active,inactive',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'logo' => $this->isMethod('POST') ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

}
