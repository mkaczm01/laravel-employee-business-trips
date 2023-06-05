<?php

declare(strict_types=1);

namespace Contracts\Services;

use Illuminate\Support\Carbon;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Support\Collection;

interface IBusinessTripQuery
{
    public function getForEmployee(UuidInterface $employee_identifier): Collection;

    public function hasEmployeeBusinessTripInDates(UuidInterface $employee_identifier, Carbon $start, Carbon $end): bool;
}
