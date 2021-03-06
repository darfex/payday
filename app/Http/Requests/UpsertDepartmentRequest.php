<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertDepartmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('departments', 'name')->ignore($this->department),
            ],
            'description' => [
                'nullable',
                'sometimes',
                'string',
            ],
        ];
    }
}
