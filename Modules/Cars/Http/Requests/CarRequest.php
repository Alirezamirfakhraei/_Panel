<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userID' => 'required|string',
            'company' => 'required|string',
            'model' => 'required|string',
            'plate' => 'required',
            'year' => 'required|string',
            'km_current' => 'required',
            'third_insurance' => 'required|string',
            'chassis_number' => 'required|string|digits:17',
            'engine_number' => 'required|string|digits:17',
        ];
    }
}
