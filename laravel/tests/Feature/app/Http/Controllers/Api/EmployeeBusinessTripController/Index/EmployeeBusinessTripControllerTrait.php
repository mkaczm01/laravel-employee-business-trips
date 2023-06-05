<?php

declare(strict_types=1);

namespace Tests\Feature\app\Http\Controllers\Api\EmployeeBusinessTripController\Index;

use App\Models\Employee;
use App\Models\BusinessTrip;
use Illuminate\Support\Carbon;

trait EmployeeBusinessTripControllerTrait
{
    public function createEmployee(array $attributes = []): Employee
    {
        return Employee::factory()->create($attributes);
    }

    public function createBusinessTrip(
        Employee $employee,
        Carbon $start,
        Carbon $end,
        string $country_iso_code,
        int $diem_rate_amount,
        string $diem_rate_currency,
        array $attributes = []
    ): BusinessTrip {
        return BusinessTrip::factory()
            ->for($employee)
            ->create(array_merge([
                'start_date' => $start,
                'end_date' => $end,
                'country_iso_code' => $country_iso_code,
                'diem_rate_amount' => $diem_rate_amount,
                'diem_rate_currency' => $diem_rate_currency,
            ], $attributes))
        ;
    }

    public function getExpectedJsonData(): array
    {
        return [
            'data' => [
                [
                    'start' => '2020-04-20 08:00:00',
                    'end' => '2020-04-21 16:00:00',
                    'country' => 'PL',
                    'amount_due' => 20,
                    'currency' => 'PLN',
                ],
                [
                    'start' => '2020-04-24 20:00:00',
                    'end' => '2020-04-28 16:00:00',
                    'country' => 'DE',
                    'amount_due' => 150,
                    'currency' => 'PLN',
                ],
            ],
        ];
    }
}
