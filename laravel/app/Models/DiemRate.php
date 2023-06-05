<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\DiemRate.
 *
 * @property        string                                         $country_iso_code
 * @property        int                                            $amount
 * @property        string                                         $currency
 * @method   static \Database\Factories\DiemRateFactory            factory($count = null, $state = [])
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate newModelQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate newQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate query()
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate whereAmount($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate whereCountryIsoCode($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|DiemRate whereCurrency($value)
 * @mixin \Eloquent
 */
class DiemRate extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'diem_rates';
}
