<?php

declare(strict_types=1);

namespace Tests\Unit\BusinessTrip\DiemDaysCalculator\CalculateDaysCount;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use BusinessTrip\DiemDaysCalculator;

class DiemDaysCalculatorTest extends TestCase
{
    use DiemDaysCalculatorTrait;

    protected DiemDaysCalculator $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(DiemDaysCalculator::class);
    }

    /**
     * @feature
     * @scenario
     * @case Provide valid entry data
     *
     * @expectation Calculate amount of days for diem
     *
     * @dataProvider validEntryData
     *
     * @test
     */
    public function calculateDaysCount_provideValidEntryData(Carbon $start, Carbon $end, int $expected_result): void
    {
        // GIVEN

        // WHEN
        $result = $this->service->calculateDaysCount($start, $end);

        // THEN
        $this->assertEquals($expected_result, $result);
    }
}
