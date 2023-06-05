<?php

declare(strict_types=1);

namespace UseCases\BusinessTrip;

use UseCases\BaseUseCase;
use Contracts\IIdentifiedEmployee;
use Illuminate\Support\Collection;
use Contracts\IEmployeeBusinessTrip;
use Contracts\Services\IBusinessTripQuery;

final class GetEmployeeBusinessTrips extends BaseUseCase
{
    /**
     * @return Collection<int, IEmployeeBusinessTrip>
     */
    public function get(IIdentifiedEmployee $identified_employee): Collection
    {
        return $this->domain_service_factory
            ->create(IBusinessTripQuery::class)
            ->getForEmployee($identified_employee->getIdentifier())
        ;
    }
}
