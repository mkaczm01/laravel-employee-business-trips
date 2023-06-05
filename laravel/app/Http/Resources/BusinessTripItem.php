<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;
use Contracts\IEmployeeBusinessTrip;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property IEmployeeBusinessTrip $resource
 */
#[OAT\Schema(
    schema: 'Resources\BusinessTripItem',
    properties: [
        new OAT\Property(
            property: 'start',
            type: 'string',
            example: '2020-04-20 08:00:00',
            nullable: false,
        ),
        new OAT\Property(
            property: 'end',
            type: 'string',
            example: '2020-04-21 16:00:00',
            nullable: false,
        ),
        new OAT\Property(
            property: 'country',
            type: 'string',
            example: 'PL',
            nullable: false,
        ),
        new OAT\Property(
            property: 'amount_due',
            type: 'integer',
            example: 20,
            nullable: false,
        ),
        new OAT\Property(
            property: 'currency',
            type: 'string',
            example: 'PLN',
            nullable: false,
        ),
    ]
)]
class BusinessTripItem extends JsonResource
{
    public function toArray(Request $request): array
    {
        $diem_rate = $this->resource->getDiemRate();

        return [
            'start' => $this->resource->getStartDate()->toDateTimeString(),
            'end' => $this->resource->getEndDate()->toDateTimeString(),
            'country' => $this->resource->getCountry(),
            'amount_due' => $diem_rate->getAmount(),
            'currency' => $diem_rate->getCurrency()->getIsoCode(),
        ];
    }
}
