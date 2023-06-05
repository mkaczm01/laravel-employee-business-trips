<?php

declare(strict_types=1);

namespace Contracts;

use Ramsey\Uuid\UuidInterface;

interface IIdentifiedEmployee
{
    public function getIdentifier(): UuidInterface;
}
