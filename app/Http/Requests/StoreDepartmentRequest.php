<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|unique:departments,name',
            'description' => 'nullable|sometimes|string',
        ];
    }
}