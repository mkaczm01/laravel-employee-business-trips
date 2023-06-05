<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\BusinessTripValidator\Validate;

use Tests\TestCase;
use App\Models\DiemRate;
use Illuminate\Support\Carbon;
use BusinessTrip\BusinessTripValidator;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusinessTripValidatorTest extends TestCase
{
    use DatabaseTransactions;
    use BusinessTripValidatorTrait;

    protected BusinessTripValidator $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(BusinessTripValidator::class);
    }

    /**
     * @feature Business Trip
     * @scenario Create New Business Trip for Employee
     * @case Validate entry data
     *
     * @expectation Throw exception with error
     *
     * @dataProvider invalidEntryDataProvider
     *
     * @test
     */
    public function validate_validateEntryData(string $start_date, string $end_date, string $country_iso_code, string $expected_exception_message): void
    {
        // GIVEN
        // delete diem rate for PL to test error
        DiemRate::where('country_iso_code', '=', 'PL')->forceDelete();

        $employee = $this->createEmployee();
        $this->createBusinessTrip($employee, Carbon::make('2020-04-25 08:00:00'), Carbon::make('2020-04-25 16:00:00'), 'DE');

        $request = $this->mockRequest(
            (string) $employee->uuid,
            $start_date,
            $end_date,
            $country_iso_code
        );

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expected_exception_message);

        // WHEN
        $this->service->validate($request);

        // THEN
    }
}
