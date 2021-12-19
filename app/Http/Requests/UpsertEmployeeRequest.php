<?php

namespace App\Http\Requests;

use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertEmployeeRequest extends FormRequest
{
    public function getDepartment(): Department
    {
        return Department::where('uuid', $this->departmentId)->firstOrFail();
    }

    public function rules()
    {
        return [
                'fullName' => 'required|string',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('employees', 'email')->ignore($this->employee),
                ],
                'departmentId' => 'required|string|exists:departments,uuid',
                'jobTitle' => 'required|string',
                // TODO enum validation
                'paymentType' => 'required|string',
                'salary' => 'required_if:paymentType,salary|numeric',
                'hourlyRate' => 'required_if:paymentType,hourlyRate|numeric',
        ];
    }
}