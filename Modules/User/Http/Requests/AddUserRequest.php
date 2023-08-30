<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() === true;
    }

    public function rules()
    {
        return [
            'userID'      => 'required|string|min:3|max:190',
            'email'     => 'required|email|min:3|max:190|unique:users,email',
            'name'     => 'required|string|min:3|max:190',
            'lastname'     => 'required|string|min:3|max:190',
            'telephone'     => 'required|string|min:3|max:12',
            'address'     => 'required|string|min:5',
            'national_code'     => 'required|numeric|digits:10',
        ];
    }
}
