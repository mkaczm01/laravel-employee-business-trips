<?php

declare(strict_types=1);

namespace Tests\Feature\UseCases\CreateNewEmployeeBusinessTrip\Create;

use Tests\TestCase;
use App\Models\BusinessTrip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use UseCases\BusinessTrip\CreateNewEmployeeBusinessTrip;

class CreateNewEmployeeBusinessTripTest extends TestCase
{
    use DatabaseTransactions;
    use CreateNewEmployeeBusinessTripTrait;

    protected CreateNewEmployeeBusinessTrip $use_case;

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(CreateNewEmployeeBusinessTrip::class);
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
    public function create_provideValidEntryData(): void
    {
        // GIVEN
        $employee = $this->createEmployee();
        $request = $this->mockRequest((string) $employee->uuid);

        // WHEN
        $results = $this->use_case->create($request);

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
