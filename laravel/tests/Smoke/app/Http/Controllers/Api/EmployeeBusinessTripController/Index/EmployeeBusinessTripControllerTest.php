<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeBusinessTripController\Index;

use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeBusinessTripControllerTest extends TestCase
{
    use DatabaseTransactions;
    use EmployeeBusinessTripControllerTrait;

    /**
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case Employee not exists
     *
     * @expectation Throw not found error
     *
     * @test
     */
    public function index_employeeNotExists(): void
    {
        // GIVEN
        $uuid = Uuid::uuid4();

        // WHEN
        $response = $this->getJson(route('employee.business-trip.index', ['employee' => $uuid]));

        // THEN
        $response->assertNotFound();
    }

    /**
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case One Business Trip exists for Employee
     *
     * @expectation Return valid json structure and exactly one item
     *
     * @test
     */
    public function index_oneBusinessTripExistsForEmployee(): void
    {
        // GIVEN
        $employee = $this->createEmployee();
        $business_trip_1 = $this->createBusinessTrip($employee, Carbon::make('2020-04-24 20:00:00'), Carbon::make('2020-04-28 16:00:00'), 'DE');
        $business_trip_2 = $this->createBusinessTrip($employee, Carbon::make('2020-04-20 08:00:00'), Carbon::make('2020-04-21 16:00:00'), 'PL');

        // WHEN
        $response = $this->getJson(route('employee.business-trip.index', ['employee' => $employee->uuid]));

        // THEN
        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
        $response->assertJsonStructure($this->getExpectedJsonStructure());
    }

    /**
     * @feature Business Trip
     * @scenario Get Business Trip List for Employee
     * @case No Business Trip exists for Employee
     *
     * @expectation Return empty json structure
     *
     * @test
     */
    public function index_noBusinessTripExistsForEmployee(): void
    {
        // GIVEN
        $employee = $this->createEmployee();

        // WHEN
        $response = $this->getJson(route('employee.business-trip.index', ['employee' => $employee->uuid]));

        // THEN
        $response->assertOk();
        $this->assertCount(0, $response->json('data'));
        $response->assertJsonStructure($this->getExpectedEmptyJsonStructure());
    }
}
