<?php

declare(strict_types=1);

namespace Contracts\Services;

use Contracts\IStoreEmployeeBusinessTrip;

interface IBusinessTripValidator
{
    public function validate(IStoreEmployeeBusinessTrip $request): void;
}
