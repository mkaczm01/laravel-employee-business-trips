<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeController\Store;

use Tests\TestCase;
use App\Models\Employee;
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
     * @expectation Return Employee identifier in response
     *
     * @test
     */
    public function store_provideNoEntryData(): void
    {
        // GIVEN

        // WHEN
        $response = $this->postJson(route('employee.store'));

        // THEN
        $response->assertCreated();
        $response->assertJsonStructure($this->getExpectedJsonStructure());
    }
}
