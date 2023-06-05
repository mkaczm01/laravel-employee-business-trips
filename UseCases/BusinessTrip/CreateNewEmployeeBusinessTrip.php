<?php

declare(strict_types=1);

namespace UseCases\BusinessTrip;

use UseCases\BaseUseCase;
use Contracts\IIdentifiedBusinessTrip;
use Contracts\IStoreEmployeeBusinessTrip;
use Contracts\Services\IBusinessTripCommand;
use Contracts\Services\IBusinessTripValidator;

final class CreateNewEmployeeBusinessTrip extends BaseUseCase
{
    public function create(IStoreEmployeeBusinessTrip $request): IIdentifiedBusinessTrip
    {
        $this->validate($request);

        return $this->createBusinessTrip($request);
    }

    private function validate(IStoreEmployeeBusinessTrip $request): void
    {
        $this->domain_service_factory
            ->create(IBusinessTripValidator::class)
            ->validate($request)
        ;
    }

    private function createBusinessTrip(IStoreEmployeeBusinessTrip $request): IIdentifiedBusinessTrip
    {
        return $this->domain_service_factory
            ->create(IBusinessTripCommand::class)
            ->createForEmployee($request)
        ;
    }
}
