<?php

declare(strict_types=1);

namespace BusinessTrip;

use Contracts\IIdentifiedBusinessTrip;
use Contracts\IStoreEmployeeBusinessTrip;
use BusinessTrip\Entities\Enums\CountryCode;
use Contracts\Services\IBusinessTripCommand;
use BusinessTrip\Entities\Models\BusinessTrip;

class BusinessTripCommand implements IBusinessTripCommand
{
    public function __construct(
        private readonly BusinessTrip $business_trip_model,
        private readonly DiemCalculator $diem_calculator
    ) {
    }

    public function createForEmployee(IStoreEmployeeBusinessTrip $request): IIdentifiedBusinessTrip
    {
        $country_code = CountryCode::from($request->getCountryCode());
        $diem_rate = $this->diem_calculator->calculate($request->getStartDateTime(), $request->getEndDateTime(), $country_code);

        return $this->business_trip_model->newQuery()->create([
            'employee_uuid' => $request->getIdentifier(),
            'start_date' => $request->getStartDateTime(),
            'end_date' => $request->getEndDateTime(),
            'country_iso_code' => $request->getCountryCode(),
            'diem_rate_amount' => $diem_rate->getAmount(),
            'diem_rate_currency' => $diem_rate->getCurrency()->getIsoCode(),
        ]);
    }
}
