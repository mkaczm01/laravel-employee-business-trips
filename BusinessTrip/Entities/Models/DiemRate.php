<?php

declare(strict_types=1);

namespace BusinessTrip\Entities\Models;

use App\Models\DiemRate as BaseModel;
use Illuminate\Database\Eloquent\Builder;
use BusinessTrip\Entities\Enums\CountryCode;

class DiemRate extends BaseModel
{
    /**
     * @param Builder<DiemRate> $builder
     */
    public function scopeByCountryCode(Builder $builder, CountryCode $country_code): void
    {
        $builder->where('country_iso_code', '=', $country_code->value);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
