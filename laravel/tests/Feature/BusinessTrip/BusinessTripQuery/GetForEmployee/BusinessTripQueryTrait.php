<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripQuery\GetForEmployee;

use App\Models\Employee;
use App\Models\BusinessTrip;
use Illuminate\Support\Carbon;

trait BusinessTripQueryTrait
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

    public static function validEntryDataProvider(): iterable
    {
        yield '2023-04-19 08:00:00 - 2023-04-19 16:00:00' => [
            'start_date' => Carbon::make('2023-04-19 08:00:00'),
            'end_date' => Carbon::make('2023-04-19 16:00:00'),
            'expected_results' => false,
        ];

        yield '2023-04-19 08:00:00 - 2023-04-21 16:00:00' => [
            'start_date' => Carbon::make('2023-04-19 08:00:00'),
            'end_date' => Carbon::make('2023-04-21 16:00:00'),
            'expected_results' => true,
        ];

        yield '2023-04-21 08:00:00 - 2023-04-24 16:00:00' => [
            'start_date' => Carbon::make('2023-04-21 08:00:00'),
            'end_date' => Carbon::make('2023-04-24 16:00:00'),
            'expected_results' => true,
        ];

        yield '2023-04-24 08:00:00 - 2023-04-26 16:00:00' => [
            'start_date' => Carbon::make('2023-04-24 08:00:00'),
            'end_date' => Carbon::make('2023-04-26 16:00:00'),
            'expected_results' => true,
        ];

        yield '2023-04-19 08:00:00 - 2023-04-26 16:00:00' => [
            'start_date' => Carbon::make('2023-04-19 08:00:00'),
            'end_date' => Carbon::make('2023-04-26 16:00:00'),
            'expected_results' => true,
        ];

        yield '2023-04-26 08:00:00 - 2023-04-26 16:00:00' => [
            'start_date' => Carbon::make('2023-04-26 08:00:00'),
            'end_date' => Carbon::make('2023-04-26 16:00:00'),
            'expected_results' => false,
        ];
    }
}
