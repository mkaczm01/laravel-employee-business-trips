<?php

declare(strict_types=1);

namespace Tests\Feature\UseCases\CreateNewEmployeeBusinessTrip\Create;

use Mockery as m;
use Ramsey\Uuid\Uuid;
use App\Models\Employee;
use Mockery\MockInterface;
use Illuminate\Support\Carbon;
use Contracts\IStoreEmployeeBusinessTrip;

trait CreateNewEmployeeBusinessTripTrait
{
    public function createEmployee(array $attributes = []): Employee
    {
        return Employee::factory()->create($attributes);
    }

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
}
