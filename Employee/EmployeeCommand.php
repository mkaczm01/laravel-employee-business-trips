<?php

declare(strict_types=1);

namespace Employee;

use Employee\Entities\EmployeeId;
use Contracts\IIdentifiedEmployee;
use Employee\Entities\Models\Employee;
use Contracts\Services\IEmployeeCommand;

class EmployeeCommand implements IEmployeeCommand
{
    public function __construct(
        private readonly Employee $employee_model,
    ) {
    }

    public function create(): IIdentifiedEmployee
    {
        /** @var Employee $employee */
        $employee = $this->employee_model->newQuery()
            ->create([
                'uuid' => (new EmployeeId())->getId(),
            ])
        ;

        return $employee;
    }
}
