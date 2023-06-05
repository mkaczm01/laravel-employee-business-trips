<?php

declare(strict_types=1);

namespace Employee\Entities;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class EmployeeId
{
    protected UuidInterface $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id
            ? Uuid::fromString($id)
            : Uuid::uuid4();
    }

    public function getId(): string
    {
        return $this->id->toString();
    }
}
