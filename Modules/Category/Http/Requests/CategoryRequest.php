<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Category\Models\Category;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() === true;
    }

    public function rules()
    {
        $rules = [
            'parentID' => 'nullable|exists:mysql_second.categories,id',
            'title' => 'required|string|min:3|max:190|unique:categories,id',
            'keywords' => 'nullable|string|min:3|max:250',
            'description' => 'nullable|string|min:3',
            'status' => ['required', 'string', Rule::in(Category::$statuses)],
        ];

        if (request()->method === 'PATCH') {
            $rules['title'] = 'required|string|min:3|max:190|unique:categories,id,' . request()->id;
        }

        return $rules;
    }
}
