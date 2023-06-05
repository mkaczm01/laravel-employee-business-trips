<?php

declare(strict_types=1);

namespace Contracts;

use Illuminate\Support\Carbon;

interface IStoreEmployeeBusinessTrip extends IIdentifiedEmployee
{
    public function getStartDateTime(): Carbon;

    public function getEndDateTime(): Carbon;

    public function getCountryCode(): string;
}
