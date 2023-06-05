<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripValidator\Validate;

use Mockery as m;
use Ramsey\Uuid\Uuid;
use App\Models\Employee;
use Mockery\MockInterface;
use App\Models\BusinessTrip;
use Illuminate\Support\Carbon;
use Contracts\IStoreEmployeeBusinessTrip;

trait BusinessTripValidatorTrait
{
    public function mockRequest(
        string $employee_identifier,
        string $start_date = '2020-04-20 08:00:00',
        string $end_date = '2020-04-21 16:00:00',
        string $country_iso_code = 'PL'
    ): MockInterface|IStoreEmployeeBusinessTrip {
        $mock = m::mock(IStoreEmployeeBusinessTrip::class);

        $mock->allows([
            'getIdentifier' => Uuid::fromString($employee_identifier),
            'getStartDateTime' => Carbon::make($start_date),
            'getEndDateTime' => Carbon::make($end_date),
            'getCountryCode' => $country_iso_code,
        ]);

        return $mock;
    }

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

    public static function invalidEntryDataProvider(): iterable
    {
        yield 'foo, invalid country code' => [
            'start_date' => '2020-04-20 08:00:00',
            'end_date' => '2020-04-21 16:00:00',
            'country_iso_code' => 'foo',
            'expected_exception_message' => 'Invalid country code.',
        ];

        yield 'PL, diem rate not found' => [
            'start_date' => '2020-04-20 08:00:00',
            'end_date' => '2020-04-21 16:00:00',
            'country_iso_code' => 'PL',
            'expected_exception_message' => 'Diem rate not found.',
        ];

        yield 'DE, start date greater than or equal to end date' => [
            'start_date' => '2020-04-21 08:00:00',
            'end_date' => '2020-04-20 16:00:00',
            'country_iso_code' => 'DE',
            'expected_exception_message' => 'Start date greater than or equal to end date.',
        ];

        yield 'DE, already has business trip in dates' => [
            'start_date' => '2020-04-25 08:00:00',
            'end_date' => '2020-04-25 16:00:00',
            'country_iso_code' => 'DE',
            'expected_exception_message' => 'Already has business trip in dates.',
        ];
    }
}
