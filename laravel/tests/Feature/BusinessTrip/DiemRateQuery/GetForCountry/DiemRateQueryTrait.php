<?php

declare(strict_types=1);

namespace Tests\Feature\BusinessTrip\DiemRateQuery\GetForCountry;

use App\Models\DiemRate;

trait DiemRateQueryTrait
{
    public function createDiemRate(string $country_code, int $amount, string $currency_code): DiemRate
    {
        return DiemRate::factory()->create([
            'country_iso_code' => $country_code,
            'amount' => $amount,
            'currency' => $currency_code,
        ]);
    }
}
