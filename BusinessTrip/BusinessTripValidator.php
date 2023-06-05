<?php

declare(strict_types=1);

namespace BusinessTrip;

use Contracts\IStoreEmployeeBusinessTrip;
use BusinessTrip\Entities\Enums\CountryCode;
use Contracts\Services\IBusinessTripValidator;

class BusinessTripValidator implements IBusinessTripValidator
{
    public function __construct(
        private readonly BusinessTripQuery $business_trip_service,
        private readonly DiemRateQuery $diem_rate_query
    ) {
    }

    public function validate(IStoreEmployeeBusinessTrip $request): void
    {
        $this->isValidCountryCode($request->getCountryCode());

        if ($request->getStartDateTime()->greaterThanOrEqualTo($request->getEndDateTime())) {
            throw new \Exception('Start date greater than or equal to end date.');
        }

        if ($this->business_trip_service->hasEmployeeBusinessTripInDates($request->getIdentifier(), $request->getStartDateTime(), $request->getEndDateTime())) {
            throw new \Exception('Already has business trip in dates.');
        }
    }

    private function isValidCountryCode(string $country_code): void
    {
        try {
            $country_code_enum = CountryCode::from($country_code);
        } catch (\Throwable $throwable) {
            throw new \Exception(message: 'Invalid country code.', previous: $throwable);
        }

        $this->diem_rate_query->getForCountry($country_code_enum);
    }
}
