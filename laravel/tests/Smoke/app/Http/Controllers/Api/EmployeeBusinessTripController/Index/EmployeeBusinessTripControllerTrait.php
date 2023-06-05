<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeBusinessTripController\Index;

use App\Models\Employee;
use App\Models\BusinessTrip;
use Illuminate\Support\Carbon;

trait EmployeeBusinessTripControllerTrait
{
    public function createEmployee(array $attributes = []): Employee
    {
        return Employee::factory()->create($attributes);
    }

    public function createBusinessTrip(Employee $employee, Carbon $start, Carbon $end, string $country_iso_code, array $attributes = []): BusinessTrip
    {
        return BusinessTrip::factory()
            ->for($employee)
            ->create(array_merge([
                'start_date' => $start,
                'end_date' => $end,
                'country_iso_code' => $country_iso_code,
            ], $attributes))
        ;
    }

    public function getExpectedJsonStructure(): array
    {
        return [
            'data' => [
                [
                    'start',
                    'end',
                    'country',
                    'amount_due',
                    'currency',
                ],
            ],
        ];
    }

    public function getExpectedEmptyJsonStructure(): array
    {
        return [
            'data' => [],
        ];
    }
}
