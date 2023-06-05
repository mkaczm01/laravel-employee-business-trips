<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Employee.
 *
 * @property        string                                                                  $uuid
 * @property        null|\Illuminate\Support\Carbon                                         $created_at
 * @property        null|\Illuminate\Support\Carbon                                         $updated_at
 * @property        \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusinessTrip> $businessTrips
 * @property        null|int                                                                $business_trips_count
 * @method   static \Database\Factories\EmployeeFactory                                     factory($count = null, $state = [])
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          newModelQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          newQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          query()
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          whereCreatedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          whereUpdatedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Employee                          whereUuid($value)
 * @mixin \Eloquent
 */
class Employee extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'employees';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $guarded = [];

    protected const BUSINESS_TRIP = BusinessTrip::class;

    public function businessTrips(): HasMany
    {
        return $this->hasMany(
            static::BUSINESS_TRIP
        );
    }
}
