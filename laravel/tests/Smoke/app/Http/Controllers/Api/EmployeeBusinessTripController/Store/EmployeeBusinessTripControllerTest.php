<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeBusinessTripController\Store;

use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeBusinessTripControllerTest extends TestCase
{
    use DatabaseTransactions;
    use EmployeeBusinessTripControllerTrait;

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Employee does not exists
     *
     * @expectation Throw not found error
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function store_employeeDoesNotExists(array $entry_data): void
    {
        // GIVEN
        $uuid = Uuid::uuid4();

        // WHEN
        $response = $this->postJson(route('employee.business-trip.store', ['employee' => $uuid]), $entry_data);

        // THEN
        $response->assertNotFound();
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Invalid Employee identifier format
     *
     * @expectation Throw not found error
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function store_invalidEmployeeIdentifierFormat(array $entry_data): void
    {
        // GIVEN

        // WHEN
        $response = $this->postJson(route('employee.business-trip.store', ['employee' => 'foo']), $entry_data);

        // THEN
        $response->assertNotFound();
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Provide valid entry data
     *
     * @expectation Return valid json structure
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function store_provideValidEntryData(array $entry_data): void
    {
        // GIVEN
        $employee = $this->createEmployee();

        // WHEN
        $response = $this->postJson(route('employee.business-trip.store', ['employee' => $employee->uuid]), $entry_data);

        // THEN
        $response->assertCreated();
        $response->assertJsonStructure($this->getExpectedJsonStructure());
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Provide invalid entry data
     *
     * @expectation Return valid json structure
     *
     * @dataProvider invalidEntryDataProvider
     *
     * @test
     */
    public function store_provideInvalidEntryData(array $entry_data): void
    {
        // GIVEN
        $employee = $this->createEmployee();

        // WHEN
        $response = $this->postJson(route('employee.business-trip.store', ['employee' => $employee->uuid]), $entry_data);

        // THEN
        $response->assertUnprocessable();
    }
}
