<?php

declare(strict_types=1);

namespace Tests\Feature\app\Http\Controllers\Api\EmployeeController\Store;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeControllerTest extends TestCase
{
    use DatabaseTransactions;
    use EmployeeControllerTrait;

    /**
     * @feature Employee
     * @scenario Create new Employee
     * @case Provide no entry data
     *
     * @expectation Return valid identifier in response
     *
     * @test
     */
    public function store_provideNoEntryData(): void
    {
        // GIVEN
        $expected_uuid = '177ef0d8-6630-11ea-b69a-0242ac130003';
        $this->fakeUuid($expected_uuid);

        // WHEN
        $response = $this->postJson(route('employee.store'));

        // THEN
        $response->assertCreated();
        $this->assertEquals($expected_uuid, $response->json('data.identifier'));
    }
}
