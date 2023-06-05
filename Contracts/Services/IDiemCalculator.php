<?php

declare(strict_types=1);

namespace Contracts\Services;

use Contracts\IMoney;
use Illuminate\Support\Carbon;
use BusinessTrip\Entities\Enums\CountryCode;

interface IDiemCalculator
{
    public function calculate(Carbon $start, Carbon $end, CountryCode $country_code): IMoney;
}
