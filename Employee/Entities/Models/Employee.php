<?php

declare(strict_types=1);

namespace Employee\Entities\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Contracts\IIdentifiedEmployee;
use App\Models\Employee as BaseModel;

class Employee extends BaseModel implements IIdentifiedEmployee
{
    public function getIdentifier(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }
}
