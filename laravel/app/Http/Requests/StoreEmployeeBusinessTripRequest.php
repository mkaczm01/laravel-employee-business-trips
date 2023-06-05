<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Ramsey\Uuid\Uuid;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Rules\CountryCodeRule;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OAT;
use Ramsey\Uuid\UuidInterface;
use Contracts\IStoreEmployeeBusinessTrip;
use Illuminate\Foundation\Http\FormRequest;

#[OAT\Schema(
    schema: 'Requests\StoreEmployeeBusinessTrip',
    required: [
        'start',
        'end',
        'country',
    ],
    properties: [
        new OAT\Property(
            property: 'start',
            type: 'string',
            format: 'date-time',
            example: '2020-04-20 08:00:00',
            nullable: false,
        ),
        new OAT\Property(
            property: 'end',
            type: 'string',
            format: 'date-time',
            example: '2020-04-21 16:00:00',
            nullable: false,
        ),
        new OAT\Property(
            property: 'country',
            enum: ['DE', 'GB', 'PL'],
            nullable: false,
        ),
    ],
)]
class StoreEmployeeBusinessTripRequest extends FormRequest implements IStoreEmployeeBusinessTrip
{
    public function rules(): array
    {
        return [
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'country' => ['required', 'string', new CountryCodeRule()],
        ];
    }

    public function validationData(): array
    {
        return array_merge(
            $this->all(),
            [
                'country' => Str::upper($this->input('country')),
            ]
        );
    }

    public function getStartDateTime(): Carbon
    {
        return $this->date('start');
    }

    public function getEndDateTime(): Carbon
    {
        return $this->date('end');
    }

    public function getIdentifier(): UuidInterface
    {
        /** @var Employee $employee */
        $employee = $this->route('employee');

        return Uuid::fromString($employee->uuid);
    }

    public function getCountryCode(): string
    {
        return $this->input('country');
    }
}
