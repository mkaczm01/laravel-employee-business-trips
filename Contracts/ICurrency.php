<?php

declare(strict_types=1);

namespace Contracts;

interface ICurrency
{
    public function getIsoCode(): string;
}
