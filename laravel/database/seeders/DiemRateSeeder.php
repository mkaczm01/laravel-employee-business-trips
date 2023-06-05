<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\DiemRate;
use Illuminate\Database\Seeder;

class DiemRateSeeder extends Seeder
{
    public function run(): void
    {
        DiemRate::factory()->create([
            'country_iso_code' => 'PL',
            'amount' => 10,
            'currency' => 'PLN',
        ]);

        DiemRate::factory()->create([
            'country_iso_code' => 'DE',
            'amount' => 50,
            'currency' => 'PLN',
        ]);

        DiemRate::factory()->create([
            'country_iso_code' => 'GB',
            'amount' => 75,
            'currency' => 'PLN',
        ]);
    }
}
