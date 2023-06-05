<?php

declare(strict_types=1);

namespace Tests\Unit\BusinessTrip\DiemCalculator\Calculate;

use Mockery as m;
use Contracts\IMoney;
use Contracts\ICurrency;
use Mockery\MockInterface;
use Illuminate\Support\Carbon;
use BusinessTrip\DiemRateQuery;
use BusinessTrip\DiemDaysCalculator;
use BusinessTrip\Entities\Enums\CountryCode;

trait DiemCalculatorTrait
{
    public static function validEntryDataProvider(): iterable
    {
        yield 'example from task #1' => [
            'start_date' => Carbon::make('2020-04-20 8:00:00'),
            'end_date' => Carbon::make('2020-04-21 16:00:00'),
            'country_code' => CountryCode::PL,
            'days_count' => 2,
            'diem_rate_amount' => 10,
            'expected_diem_rate_amount' => 20,
            'expected_diem_rate_currency' => 'PLN',
        ];

        yield 'example from task #2' => [
            'start_date' => Carbon::make('2020-04-24 20:00:00'),
            'end_date' => Carbon::make('2020-04-28 16:00:00'),
            'country_code' => CountryCode::DE,
            'days_count' => 3,
            'diem_rate_amount' => 50,
            'expected_diem_rate_amount' => 150,
            'expected_diem_rate_currency' => 'PLN',
        ];

        yield '5 days in PL' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-28 16:00:00'),
            'country_code' => CountryCode::PL,
            'days_count' => 5,
            'diem_rate_amount' => 10,
            'expected_diem_rate_amount' => 50,
            'expected_diem_rate_currency' => 'PLN',
        ];

        yield '0 days in DE' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-24 10:00:00'),
            'country_code' => CountryCode::DE,
            'days_count' => 0,
            'diem_rate_amount' => 50,
            'expected_diem_rate_amount' => 0,
            'expected_diem_rate_currency' => 'PLN',
        ];

        yield '4 days in GB' => [
            'start_date' => Carbon::make('2023-04-19 10:00:00'),
            'end_date' => Carbon::make('2023-04-25 16:00:00'),
            'country_code' => CountryCode::GB,
            'days_count' => 4,
            'diem_rate_amount' => 75,
            'expected_diem_rate_amount' => 300,
            'expected_diem_rate_currency' => 'PLN',
        ];

        yield '10 days in DE' => [
            'start_date' => Carbon::make('2023-04-10 8:00:00'),
            'end_date' => Carbon::make('2023-04-23 16:00:00'),
            'country_code' => CountryCode::DE,
            'days_count' => 10,
            'diem_rate_amount' => 50,
            'expected_diem_rate_amount' => 650,
            'expected_diem_rate_currency' => 'PLN',
        ];
    }

    public function mockDiemDayCalculator(int $expected_days_count): MockInterface|DiemDaysCalculator
    {
        $mock = m::mock(DiemDaysCalculator::class);
        $mock->expects('calculateDaysCount')->andReturns($expected_days_count);

        return $mock;
    }

    public function mockDiemRateQuery(IMoney $expected_diem_rate_amount): MockInterface|DiemRateQuery
    {
        $mock = m::mock(DiemRateQuery::class);
        $mock->expects('getForCountry')->andReturns($expected_diem_rate_amount);

        return $mock;
    }

    public function mockIMoney(int $amount, string $currency_code = 'PLN'): IMoney
    {
        $mock = m::mock(IMoney::class);

        $mock->allows([
            'getAmount' => $amount,
            'getCurrency' => $this->mockICurrency($currency_code),
        ]);

        return $mock;
    }

    public function mockICurrency(string $currency_code): ICurrency
    {
        $mock = m::mock(ICurrency::class);

        $mock->allows([
            'getIsoCode' => $currency_code,
        ]);

        return $mock;
    }
}
