<?php

declare(strict_types=1);

namespace Tests\Feature\app\Http\Controllers\Api\EmployeeBusinessTripController\Index;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeBusinessTripControllerTest extends TestCase
{
    use DatabaseTransactions;
    use EmployeeBusinessTripControllerTrait;

    /**
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case Employee has two Business Trips
     *
     * @expectation Return valid data in response
     *
     * @test
     */
    public function index_employeeHasTwoBusinessTrips(): void
    {
        // GIVEN
        $employee = $this->createEmployee();
        $business_trip_1 = $this->createBusinessTrip($employee, Carbon::make('2020-04-24 20:00:00'), Carbon::make('2020-04-28 16:00:00'), 'DE', 150, 'PLN');
        $business_trip_2 = $this->createBusinessTrip($employee, Carbon::make('2020-04-20 08:00:00'), Carbon::make('2020-04-21 16:00:00'), 'PL', 20, 'PLN');

        // WHEN
        $response = $this->getJson(route('employee.business-trip.index', ['employee' => $employee->uuid]));

        // THEN
        $response->assertOk();
        $response->assertExactJson($this->getExpectedJsonData());
    }
}
