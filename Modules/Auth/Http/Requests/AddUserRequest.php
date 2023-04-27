<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userID' => 'required|userID|string',
            'name' => 'required|string|min:2',
            'lastname' => 'required|string|min:2',
            'gender' => 'required',
            'address' => 'nullable|string|between:1,100',
            'telephone' => 'nullable|string|min:2',
        ];
    }
}
