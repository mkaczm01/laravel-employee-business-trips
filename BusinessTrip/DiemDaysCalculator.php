<?php

declare(strict_types=1);

namespace BusinessTrip;

use Carbon\CarbonPeriod;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class DiemDaysCalculator
{
    private const MINIMUM_HOURS = 8;

    public function calculateDaysCount(Carbon $start, Carbon $end): int
    {
        $diem_days = 0;

        $period = $this->createPeriod($start, $end);

        foreach ($period as $date) {
            if ($this->isSaturdayOrSunday($date)) {
                continue;
            }

            if ($this->isLastDayAndLessThanMinimumHours($date, $end)) {
                continue;
            }

            ++$diem_days;
        }

        return $diem_days;
    }

    private function createPeriod(CarbonInterface $start, CarbonInterface $end): CarbonPeriod
    {
        return CarbonPeriod::between($start, $end);
    }

    private function isSaturdayOrSunday(CarbonInterface $date): bool
    {
        return $date->isSaturday() || $date->isSunday();
    }

    private function isLastDayAndLessThanMinimumHours(CarbonInterface $date, CarbonInterface $end): bool
    {
        if (!$date->isSameDay($end)) {
            return false;
        }

        return $date->diffInHours($end) < self::MINIMUM_HOURS;
    }
}
