<?php

declare(strict_types=1);

namespace BusinessTrip\Entities;

use Contracts\IMoney;
use Contracts\ICurrency;

readonly class Money implements IMoney
{
    private Currency $currency;

    public function __construct(
        private int $amount,
        string $currency
    ) {
        $this->currency = new Currency($currency);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): ICurrency
    {
        return $this->currency;
    }
}
