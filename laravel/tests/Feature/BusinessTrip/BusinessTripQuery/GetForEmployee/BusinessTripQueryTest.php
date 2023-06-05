<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripQuery\GetForEmployee;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use BusinessTrip\BusinessTripQuery;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusinessTripQueryTest extends TestCase
{
    use DatabaseTransactions;
    use BusinessTripQueryTrait;

    protected BusinessTripQuery $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(BusinessTripQuery::class);
    }

    /**
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case Employee has two business trips
     *
     * @expectation
     *
     * @test
     */
    public function hasEmployeeBusinessTripInDates_employeeHasTwoBusinessTrips(): void
    {
        // GIVEN
        $employee = $this->createEmployee();
        $business_trip_1 = $this->createBusinessTrip($employee, Carbon::make('2020-04-20 08:00:00'), Carbon::make('2020-04-21 16:00:00'), 'PL');
        $business_trip_2 = $this->createBusinessTrip($employee, Carbon::make('2020-04-24 20:00:00'), Carbon::make('2020-04-28 16:00:00'), 'DE');

        // WHEN
        $results = $this->service->getForEmployee($employee->uuid);

        // THEN
        $this->assertCount(2, $results);
    }

    /*
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case Employee has two business trips
     *
     * @expectation
     *
     * @test
     */
//    public function hasEmployeeBusinessTripInDates_employeeHasTwoBusinessTrips(): void
//    {
//        // GIVEN
//        $employee = $this->createEmployee();
//        $business_trip_1 = $this->createBusinessTrip($employee, Carbon::make('2020-04-20 08:00:00'), Carbon::make('2020-04-21 16:00:00'), 'PL');
//
//        // WHEN
//        $results = $this->service->getForEmployee($employee->uuid);
//
//        // THEN
//        $first = $results->first();
//
//        $this->assertEquals('2020-04-20 08:00:00', $first->getStartDate()->toDateTimeString());
//        $this->assertEquals('2020-04-21 16:00:00', $first->getEndDate()->toDateTimeString());
//        $this->assertEquals(20, $first->getDiemRate()->getAmount());
//        $this->assertEquals('PLN', $first->getDiemRate()->getCurrency()->getIsoCode());
//    }
}
