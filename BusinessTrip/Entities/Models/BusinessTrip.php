<?php

declare(strict_types=1);

namespace BusinessTrip\Entities\Models;

use Contracts\IMoney;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\UuidInterface;
use BusinessTrip\Entities\Money;
use Contracts\IEmployeeBusinessTrip;
use Contracts\IIdentifiedBusinessTrip;
use App\Models\BusinessTrip as BaseModel;
use Illuminate\Database\Eloquent\Builder;

class BusinessTrip extends BaseModel implements IIdentifiedBusinessTrip, IEmployeeBusinessTrip
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    public function getEndDate(): Carbon
    {
        return $this->end_date;
    }

    public function getCountry(): string
    {
        return $this->country_iso_code;
    }

    public function getDiemRate(): IMoney
    {
        return new Money(
            $this->diem_rate_amount,
            $this->diem_rate_currency
        );
    }

    public function scopeByEmployeeIdentifier(Builder $builder, UuidInterface $employee_identifier): void
    {
        $builder->where('employee_uuid', '=', $employee_identifier->toString());
    }

    public function scopeInSelectedDates(Builder $builder, Carbon $start, Carbon $end): void
    {
        $builder->where(function (Builder $builder) use ($start, $end) {
            $builder->orWhere(function (Builder $builder) use ($start, $end) {
                $builder->whereDate('start_date', '>=', $start);
                $builder->whereDate('end_date', '>=', $start);
                $builder->whereDate('start_date', '<=', $end);
                $builder->whereDate('end_date', '>=', $end);
            });

            $builder->orWhere(function (Builder $builder) use ($start, $end) {
                $builder->whereDate('start_date', '<=', $start);
                $builder->whereDate('end_date', '>=', $start);
                $builder->whereDate('start_date', '<=', $end);
                $builder->whereDate('end_date', '>=', $end);
            });

            $builder->orWhere(function (Builder $builder) use ($start, $end) {
                $builder->whereDate('start_date', '<=', $start);
                $builder->whereDate('end_date', '>=', $start);
                $builder->whereDate('start_date', '<=', $end);
                $builder->whereDate('end_date', '<=', $end);
            });

            $builder->orWhere(function (Builder $builder) use ($start, $end) {
                $builder->whereDate('start_date', '>=', $start);
                $builder->whereDate('end_date', '>=', $start);
                $builder->whereDate('start_date', '<=', $end);
                $builder->whereDate('end_date', '<=', $end);
            });
        });
    }

    public function scopeOrderByStartDate(Builder $builder, string $direction = 'asc'): void
    {
        $builder->orderBy('start_date', $direction);
    }
}
