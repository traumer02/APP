<?php

namespace App\Http\Requests\User;

use App\Services\User\Data\RegisterUserData;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email','unique:users,email', 'max:254'],
            'login' => ['required','unique:users,login'],
            'password' => ['required','confirmed'],
        ];
    }

    public function data(): RegisterUserData
    {
        return RegisterUserData::from($this->validated());
    }
}
