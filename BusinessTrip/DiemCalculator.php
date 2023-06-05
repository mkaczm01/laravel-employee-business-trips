<?php

declare(strict_types=1);

namespace BusinessTrip;

use Contracts\IMoney;
use Illuminate\Support\Carbon;
use BusinessTrip\Entities\Money;
use Contracts\Services\IDiemCalculator;
use BusinessTrip\Entities\Enums\CountryCode;

class DiemCalculator implements IDiemCalculator
{
    private const MINIMUM_DAYS_FOR_DOUBLE_DIEM = 7;

    public function __construct(
        private readonly DiemDaysCalculator $diem_day_calculator,
        private readonly DiemRateQuery $diem_rate_query
    ) {
    }

    public function calculate(Carbon $start, Carbon $end, CountryCode $country_code): IMoney
    {
        $diem_days = $this->diem_day_calculator->calculateDaysCount($start, $end);

        $diem_amount_per_day = $this->diem_rate_query->getForCountry($country_code);

        $standard_diem_amount = $diem_days * $diem_amount_per_day->getAmount();
        $doubled_diem_amount = $this->calculateDoubledDiem($diem_days, $diem_amount_per_day->getAmount());

        return new Money(
            $standard_diem_amount + $doubled_diem_amount,
            $diem_amount_per_day->getCurrency()->getIsoCode()
        );
    }

    private function calculateDoubledDiem(int $diem_days, int $diem_amount_per_day): int
    {
        if ($diem_days <= self::MINIMUM_DAYS_FOR_DOUBLE_DIEM) {
            return 0;
        }

        $days_to_be_doubled = $diem_days - self::MINIMUM_DAYS_FOR_DOUBLE_DIEM;

        return $days_to_be_doubled * $diem_amount_per_day;
    }
}
