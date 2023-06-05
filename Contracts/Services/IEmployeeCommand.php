<?php

declare(strict_types=1);

namespace Contracts\Services;

use Contracts\IIdentifiedEmployee;

interface IEmployeeCommand
{
    public function create(): IIdentifiedEmployee;
}
