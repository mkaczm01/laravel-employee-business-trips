<?php

declare(strict_types=1);

namespace BusinessTrip;

use Illuminate\Support\Carbon;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Support\Collection;
use Contracts\Services\IBusinessTripQuery;
use BusinessTrip\Entities\Models\BusinessTrip;

class BusinessTripQuery implements IBusinessTripQuery
{
    public function __construct(
        private readonly BusinessTrip $business_trip_model
    ) {
    }

    public function getForEmployee(UuidInterface $employee_identifier): Collection
    {
        $employee_business_trips = $this->business_trip_model->newQuery()
            ->byEmployeeIdentifier($employee_identifier)
            ->orderByStartDate()
            ->get()
        ;

        return $employee_business_trips;
    }

    public function hasEmployeeBusinessTripInDates(UuidInterface $employee_identifier, Carbon $start, Carbon $end): bool
    {
        $query = $this->business_trip_model->newQuery()
            ->byEmployeeIdentifier($employee_identifier)
            ->inSelectedDates($start, $end)
        ;

        return $query->exists();
    }
}
