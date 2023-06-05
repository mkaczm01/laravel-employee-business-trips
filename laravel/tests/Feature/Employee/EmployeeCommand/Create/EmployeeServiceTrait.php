<?php

declare(strict_types=1);

namespace Tests\Feature\Employee\EmployeeCommand\Create;

use App\Models\Employee;

trait EmployeeServiceTrait
{
    public function createEmployee(array $attributes = []): Employee
    {
        return Employee::factory()->create($attributes);
    }
}
