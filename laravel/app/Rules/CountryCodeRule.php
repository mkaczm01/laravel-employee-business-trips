<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class CountryCodeRule implements ValidationRule
{
    private const AVAILABLE_COUNTRY_CODES = [
        'DE',
        'GB',
        'PL',
    ];

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!in_array($value, self::AVAILABLE_COUNTRY_CODES, true)) {
            $fail('Invalid country code.');
        }
    }
}
