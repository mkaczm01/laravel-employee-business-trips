<?php

declare(strict_types=1);

namespace BusinessTrip;

use Contracts\IMoney;
use BusinessTrip\Entities\Money;
use BusinessTrip\Entities\Models\DiemRate;
use BusinessTrip\Entities\Enums\CountryCode;

class DiemRateQuery
{
    public function __construct(
        private readonly DiemRate $diem_rate_model
    ) {
    }

    public function getForCountry(CountryCode $country_code): IMoney
    {
        $diem_rate = $this->diem_rate_model->newQuery()
            ->byCountryCode($country_code)
            ->first()
        ;

        if (!$diem_rate) {
            throw new \Exception('Diem rate not found.');
        }

        return new Money(
            $diem_rate->getAmount(),
            $diem_rate->getCurrency()
        );
    }
}
