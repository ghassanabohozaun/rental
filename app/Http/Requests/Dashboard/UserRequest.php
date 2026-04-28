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
        $isSuper = user()->company_id == 1;

        return [
            'name.ar' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
            'password_confirm' => $id ? 'nullable|same:password' : 'required|same:password',
            'role_id' => 'required|exists:roles,id',
            'company_id' => $isSuper ? 'required|exists:companies,id' : 'nullable|exists:companies,id',
            'mobile' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
