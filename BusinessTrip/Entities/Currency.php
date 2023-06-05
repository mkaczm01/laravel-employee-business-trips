<?php

declare(strict_types=1);

namespace BusinessTrip\Entities;

use Contracts\ICurrency;
use BusinessTrip\Entities\Enums\CurrencyCode;

readonly class Currency implements ICurrency
{
    protected CurrencyCode $currency_code;

    public function __construct(
        string $currency_code
    ) {
        $this->currency_code = CurrencyCode::from($currency_code);
    }

    public function getIsoCode(): string
    {
        return $this->currency_code->value;
    }
}
