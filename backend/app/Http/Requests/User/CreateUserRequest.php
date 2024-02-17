<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'max:64'],
            'email'       => ['required', 'email'],
            'password'    => ['required', 'min:8', 'max:64'],
            'description' => ['max:256'],
            'icon'        => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:4096'],
        ];
    }
}
