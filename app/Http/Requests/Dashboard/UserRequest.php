<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('user');

        $rules = [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
            'password_confirm' => $id ? 'nullable|same:password' : 'required|same:password',
            'role_id' => 'required|exists:roles,id',
            'mobile' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if (user()->company_id == 1) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        return $rules;
    }
}
