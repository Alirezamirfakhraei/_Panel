<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'userID' => 'userID is required',
            'password' => 'password is required',
        ];
    }

    public function rules(): array
    {
        return [
            'userID' => 'required|unique:users|min:11|max:11',
            'password' => 'required|min:6|max:6'
        ];
    }
}
