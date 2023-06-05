<?php

declare(strict_types=1);

namespace Contracts;

use Illuminate\Support\Carbon;

interface IEmployeeBusinessTrip
{
    public function getStartDate(): Carbon;

    public function getEndDate(): Carbon;

    public function getCountry(): string;

    public function getDiemRate(): IMoney;
}
