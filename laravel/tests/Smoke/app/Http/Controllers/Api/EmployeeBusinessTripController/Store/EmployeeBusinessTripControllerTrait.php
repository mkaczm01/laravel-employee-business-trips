<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeBusinessTripController\Store;

use Ramsey\Uuid\Uuid;
use App\Models\Employee;
use BusinessTrip\Entities\Enums\CountryCode;

trait EmployeeBusinessTripControllerTrait
{
    public function createEmployee(array $attributes = []): Employee
    {
        return Employee::factory()->create($attributes);
    }

    public function getExpectedJsonStructure(): array
    {
        return [];
    }

    public static function invalidEmployeeIdentifier(): iterable
    {
        yield [
            'employee_identifier' => 'foo',
        ];

        yield [
            'employee_identifier' => Uuid::uuid4(),
        ];
    }

    public static function validEntryDataProvider(): iterable
    {
        yield [
            'entry_data' => [
                'start' => '2020-04-20 08:00:00',
                'end' => '2020-04-21 16:00:00',
                'country' => CountryCode::PL,
            ],
        ];
    }

    public static function invalidEntryDataProvider(): iterable
    {
        yield [
            'entry_data' => [
                'start' => '2020-04-20 08:00:00',
                'end' => '2020-04-21 16:00:00',
                'country' => 'foo',
            ],
        ];
    }
}
