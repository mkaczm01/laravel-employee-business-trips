<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessTrip>
 */
class BusinessTripFactory extends Factory
{
    public function definition(): array
    {
        $start_date = $this->faker->dateTime();
        $end_date = Carbon::make($start_date)->addDays(4);

        return [
            'employee_uuid' => Employee::factory(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'country_iso_code' => 'PL',
            'diem_rate_amount' => $this->faker->numberBetween(10, 100),
            'diem_rate_currency' => 'PLN',
        ];
    }
}
