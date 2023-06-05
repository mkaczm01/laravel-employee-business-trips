<?php

declare(strict_types=1);

namespace Tests\Unit\BusinessTrip\DiemCalculator\Calculate;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use BusinessTrip\DiemCalculator;
use BusinessTrip\Entities\Enums\CountryCode;

class DiemCalculatorTest extends TestCase
{
    use DiemCalculatorTrait;

    protected DiemCalculator $service;

    /**
     * @feature Feature
     * @scenario Scenario
     * @case Provide valid entry data
     *
     * @expectation Expectation
     *
     * @dataProvider validEntryDataProvider
     *
     * @test
     */
    public function calculate_provideValidEntryData(
        Carbon $start,
        Carbon $end,
        CountryCode $country_code,
        int $days_count,
        int $diem_rate_amount,
        int $expected_diem_rate_amount,
        string $expected_diem_rate_currency,
    ): void {
        // GIVEN
        $diem_day_calculator_mock = $this->mockDiemDayCalculator($days_count);
        $diem_rate_query_mock = $this->mockDiemRateQuery($this->mockIMoney($diem_rate_amount));

        $this->service = $this->app->makeWith(DiemCalculator::class, [
            'diem_day_calculator' => $diem_day_calculator_mock,
            'diem_rate_query' => $diem_rate_query_mock,
        ]);

        // WHEN
        $result = $this->service->calculate($start, $end, $country_code);

        // THEN
        $this->assertEquals($expected_diem_rate_amount, $result->getAmount());
        $this->assertEquals($expected_diem_rate_currency, $result->getCurrency()->getIsoCode());
    }
}
