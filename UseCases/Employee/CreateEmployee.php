<?php

declare(strict_types=1);

namespace UseCases\Employee;

use UseCases\BaseUseCase;
use Contracts\IIdentifiedEmployee;
use Contracts\Services\IEmployeeCommand;

final class CreateEmployee extends BaseUseCase
{
    public function create(): IIdentifiedEmployee
    {
        return $this->domain_service_factory
            ->create(IEmployeeCommand::class)
            ->create()
        ;
    }
}
