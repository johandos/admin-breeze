<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:20', 'not_regex:/\d/'],
            'surname' => ['required', 'string', 'min:2', 'max:40', 'not_regex:/\d/'],
            'dni' => ['required', 'unique:users,dni', 'regex:/^([0-9]{8}[A-Z]|[XYZ][0-9]{7}[A-Z])$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => 'nullable|regex:/^\+?[0-9]{9,12}$/',
            'country' => 'nullable|string',
            'iban' => 'required|regex:/^ES\d{2}\d{4}\d{4}\d{2}\d{10}$/',
            'about' => 'nullable|string|min:20|max:250',
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }
}

