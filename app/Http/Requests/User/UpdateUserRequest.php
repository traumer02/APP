<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . Auth::id(),
            'login' => 'sometimes|string|max:255|unique:users,login,' . Auth::id(),
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'sometimes|nullable|string',
        ];
    }
}
