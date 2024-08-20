<?php

namespace App\Http\Requests\User;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
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
        return [
            'avatar' => ['required', 'mimes:jpeg,jpg,png', 'max:10000'],
        ];
    }

    public function avatar(): array|\Illuminate\Http\UploadedFile
    {
        return $this->file('avatar');
    }
}
