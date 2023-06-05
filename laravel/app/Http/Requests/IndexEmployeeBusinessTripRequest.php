<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Ramsey\Uuid\Uuid;
use App\Models\Employee;
use OpenApi\Attributes as OAT;
use Ramsey\Uuid\UuidInterface;
use Contracts\IIdentifiedEmployee;
use Illuminate\Foundation\Http\FormRequest;

#[OAT\Schema(
    schema: 'Requests\IndexEmployeeBusinessTripRequest',
    required: [
        'start',
        'end',
        'country',
    ],
    properties: [],
)]
class IndexEmployeeBusinessTripRequest extends FormRequest implements IIdentifiedEmployee
{
    public function rules(): array
    {
        return [];
    }

    public function getIdentifier(): UuidInterface
    {
        /** @var Employee $employee */
        $employee = $this->route('employee');

        return Uuid::fromString($employee->uuid);
    }
}
