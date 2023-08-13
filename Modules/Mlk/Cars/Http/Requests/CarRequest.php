<?php

namespace Mlk\Cars\Http\Requests;

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
            'model' => 'required|string|exists:mysql_second.cars,id',
            'plate' => 'required',
            'year' => 'required|string',
            'km_current' => 'required',
            'third_insurance' => 'required|string',
        ];
    }
}
