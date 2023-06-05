<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripQuery\HasEmployeeBusinessTripInDates;

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
     * @scenario Create New Business Trip for Employee
     * @case Provide multiple entry data
     *
     * @expectation Return valid information if Employee has already created Business Trip in selected days
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function hasEmployeeBusinessTripInDates_provideMultipleEntryData(Carbon $start_date, Carbon $end_date, bool $expected_results): void
    {
        // GIVEN
        $business_trip_start = Carbon::make('2023-04-20 08:00:00');
        $business_trip_end = Carbon::make('2023-04-25 16:00:00');

        $employee = $this->createEmployee();
        $business_trip = $this->createBusinessTrip($employee, $business_trip_start, $business_trip_end);

        // WHEN
        $results = $this->service->hasEmployeeBusinessTripInDates(
            $employee->uuid,
            $start_date,
            $end_date
        );

        // THEN
        $this->assertEquals($expected_results, $results);
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Provide multiple entry data and no Business Trip exists for Employee
     *
     * @expectation Return information that Employee has not already created Business Trip in selected days
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function hasEmployeeBusinessTripInDates_provideMultipleEntryDataAndNoBusinessTripExistsForEmployee(Carbon $start_date, Carbon $end_date): void
    {
        // GIVEN
        $employee = $this->createEmployee();

        // WHEN
        $results = $this->service->hasEmployeeBusinessTripInDates(
            $employee->uuid,
            $start_date,
            $end_date
        );

        // THEN
        $this->assertFalse($results);
    }
}
