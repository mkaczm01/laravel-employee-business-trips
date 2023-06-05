<?php

declare(strict_types=1);

namespace Contracts\Services;

use Contracts\IIdentifiedBusinessTrip;
use Contracts\IStoreEmployeeBusinessTrip;

interface IBusinessTripCommand
{
    public function createForEmployee(IStoreEmployeeBusinessTrip $request): IIdentifiedBusinessTrip;
}
