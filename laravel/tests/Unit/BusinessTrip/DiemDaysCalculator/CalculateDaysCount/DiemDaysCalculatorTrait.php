<?php

declare(strict_types=1);

namespace Tests\Unit\BusinessTrip\DiemDaysCalculator\CalculateDaysCount;

use Illuminate\Support\Carbon;

trait DiemDaysCalculatorTrait
{
    public static function validEntryData(): iterable
    {
        yield 'example from task #1' => [
            'start_date' => Carbon::make('2020-04-20 8:00:00'),
            'end_date' => Carbon::make('2020-04-21 16:00:00'),
            'expected_result' => 2,
        ];

        yield 'example from task #2' => [
            'start_date' => Carbon::make('2020-04-24 20:00:00'),
            'end_date' => Carbon::make('2020-04-28 16:00:00'),
            'expected_result' => 2,
        ];

        yield 'one workday less than 8h' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-24 15:00:00'),
            'expected_result' => 0,
        ];

        yield 'one workday equals 8h' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-24 16:00:00'),
            'expected_result' => 1,
        ];

        yield 'two weekend days' => [
            'start_date' => Carbon::make('2023-04-29 8:00:00'),
            'end_date' => Carbon::make('2023-04-30 16:00:00'),
            'expected_result' => 0,
        ];

        yield '4 workdays and last day is 8 hours day' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-28 16:00:00'),
            'expected_result' => 5,
        ];

        yield '4 workdays and last day is less than 8 hours day' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-28 10:00:00'),
            'expected_result' => 4,
        ];

        yield '5 workdays and one weekend day' => [
            'start_date' => Carbon::make('2023-04-24 8:00:00'),
            'end_date' => Carbon::make('2023-04-29 16:00:00'),
            'expected_result' => 5,
        ];

        yield '14 days with two weekends' => [
            'start_date' => Carbon::make('2023-04-10 8:00:00'),
            'end_date' => Carbon::make('2023-04-23 16:00:00'),
            'expected_result' => 10,
        ];

        yield '3 workdays, saturday, sunday and 2 workdays but with less than 8h last day' => [
            'start_date' => Carbon::make('2023-04-19 10:00:00'),
            'end_date' => Carbon::make('2023-04-25 16:00:00'),
            'expected_result' => 4,
        ];
    }
}
