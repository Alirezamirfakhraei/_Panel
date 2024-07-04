<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Milwad\LaravelValidate\Rules\ValidStrongPassword;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userID' => 'required|digits:11',
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => 'required', 'string', 'min:6', 'max:255',
            'privacy' => 'required'
        ];
    }
}
