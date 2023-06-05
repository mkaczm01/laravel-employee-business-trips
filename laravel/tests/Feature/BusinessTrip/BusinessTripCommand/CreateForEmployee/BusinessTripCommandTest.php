<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripCommand\CreateForEmployee;

use Tests\TestCase;
use App\Models\BusinessTrip;
use BusinessTrip\BusinessTripCommand;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusinessTripCommandTest extends TestCase
{
    use DatabaseTransactions;
    use BusinessTripCommandTrait;

    protected BusinessTripCommand $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(BusinessTripCommand::class);
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Provide valid entry data
     *
     * @expectation Create new Business Trip for Employee in database and return id
     *
     * @test
     */
    public function createForEmployee_provideValidEntryData(): void
    {
        // GIVEN
        $employee = $this->createEmployee();
        $request = $this->mockRequest((string) $employee->uuid);

        // WHEN
        $results = $this->service->createForEmployee($request);

        // THEN
        $this->assertDatabaseHas(BusinessTrip::class, [
            'id' => $results->getId(),
            'employee_uuid' => $employee->uuid,
            'start_date' => '2020-04-20 08:00:00',
            'end_date' => '2020-04-21 16:00:00',
            'country_iso_code' => 'PL',
        ]);
    }
}
