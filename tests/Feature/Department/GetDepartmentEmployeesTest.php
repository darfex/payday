<?php

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;

use function Pest\Laravel\getJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return all employees for a department', function () {
    $development = Department::factory(['name' => 'Development'])->create();
    $marketing = Department::factory(['name' => 'Marketing'])->create();

    $developers = Employee::factory([
        'department_id' => $development->id,
    ])->count(5)->create();

    Employee::factory([
        'department_id' => $marketing->id,
    ])->count(2)->create();

    $employees = getJson(route('department-employees.index', ['department' => $development]))
        ->json('data');

    expect($employees)->toHaveCount(5);
    expect($employees)->each(fn ($employee) => $employee->id->toBeIn($developers->pluck('uuid')));
});