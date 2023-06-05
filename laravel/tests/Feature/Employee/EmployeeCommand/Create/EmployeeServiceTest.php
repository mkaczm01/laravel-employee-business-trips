<?php

declare(strict_types=1);

namespace Tests\Feature\Employee\EmployeeCommand\Create;

use Tests\TestCase;
use App\Models\Employee;
use Employee\EmployeeCommand;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeServiceTest extends TestCase
{
    use DatabaseTransactions;
    use EmployeeServiceTrait;

    protected EmployeeCommand $service;

    protected function setUp(): void
    {
        parent::setUp();

        Employee::query()->forceDelete();

        $this->service = $this->app->make(EmployeeCommand::class);
    }

    /**
     * @feature Employee
     * @scenario Create new Employee
     * @case No Employees in database exists
     *
     * @expectation Create new Employee in database
     *
     * @test
     */
    public function create_noEmployeesInDatabaseExists(): void
    {
        // GIVEN
        $expected_uuid = '177ef0d8-6630-11ea-b69a-0242ac130003';
        $this->fakeUuid($expected_uuid);

        // WHEN
        $results = $this->service->create();

        // THEN
        $this->assertEquals($expected_uuid, $results->getIdentifier()->toString());
        $this->assertDatabaseHas(Employee::class, [
            'uuid' => $expected_uuid,
        ]);
    }

    /**
     * @feature Employee
     * @scenario Create new Employee
     * @case Another Employee in database exists
     *
     * @expectation Create new Employee in database and not modify existing one
     *
     * @test
     */
    public function create_anotherEmployeeInDatabaseExists(): void
    {
        // GIVEN
        $employee = $this->createEmployee(['uuid' => 'd76c04bd-0e37-4870-8a46-72e625d2f56f']);

        $expected_uuid = '177ef0d8-6630-11ea-b69a-0242ac130003';
        $this->fakeUuid($expected_uuid);

        // WHEN
        $results = $this->service->create();

        // THEN
        $this->assertDatabaseCount(Employee::class, 2);
        $this->assertDatabaseHas(Employee::class, [
            'uuid' => $expected_uuid,
        ]);
    }
}
