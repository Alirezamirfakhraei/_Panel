<?php

namespace Modules\Repairs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRepairRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'userID' => 'required|string|digits:11',
            'telephone' => 'string|digits:11',
            'name' => 'required|string|min:3|max:190',
            'lastname' => 'required|string|min:3|max:190',
            'national_code' => 'required|string|digits:10',
            'bcNumber' => 'required|string',
            'repairID' => 'required|string|digits:10',
            'submit_plate' => 'required|string|min:1|max:10',
            'address' => 'required|string|min:3|max:190',
            'issue_date' => 'nullable|string|min:2|max:190',
            'expiration_date' => 'nullable|string',
            'steward' => 'nullable|string',
            'fatherName' => 'nullable|string',
            'date_of_birth' => 'nullable|string',
            'repairOwner' => 'nullable|string',
            'repairShop' => 'nullable|string',
            'type_of_person' => 'nullable|string',
            'type_of_activity' => 'nullable|string',
            'union_degree' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'province_code' => 'nullable|string',
            'area' => 'nullable|string',
            'length' => 'nullable|string',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
            'street_width' => 'nullable|string',
            'members' => 'nullable|string',
        ];
    }
}
