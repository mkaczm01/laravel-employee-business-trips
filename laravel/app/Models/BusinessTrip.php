<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\BusinessTrip.
 *
 * @property        int                                                $id
 * @property        string                                             $employee_uuid
 * @property        \Illuminate\Support\Carbon                         $start_date
 * @property        \Illuminate\Support\Carbon                         $end_date
 * @property        string                                             $country_iso_code
 * @property        int                                                $diem_rate_amount
 * @property        string                                             $diem_rate_currency
 * @property        null|\Illuminate\Support\Carbon                    $created_at
 * @property        null|\Illuminate\Support\Carbon                    $updated_at
 * @property        \App\Models\Employee                               $employee
 * @method   static \Database\Factories\BusinessTripFactory            factory($count = null, $state = [])
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip newModelQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip newQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip query()
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereCountryIsoCode($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereCreatedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereDiemRateAmount($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereDiemRateCurrency($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereEmployeeUuid($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereEndDate($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereId($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereStartDate($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|BusinessTrip whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BusinessTrip extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected const EMPLOYEE = Employee::class;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(
            static::EMPLOYEE
        );
    }
}
