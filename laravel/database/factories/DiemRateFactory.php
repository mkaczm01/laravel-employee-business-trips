<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiemRate>
 */
class DiemRateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'country_iso_code' => $this->faker->countryISOAlpha3(),
            'amount' => $this->faker->numberBetween(10, 50),
            'currency' => 'PLN',
        ];
    }
}
