<?php

declare(strict_types=1);

namespace Contracts;

interface IMoney
{
    public function getAmount(): int;

    public function getCurrency(): ICurrency;
}
