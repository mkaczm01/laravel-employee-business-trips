<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;
use Contracts\IIdentifiedEmployee;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property IIdentifiedEmployee $resource
 */
#[OAT\Schema(
    schema: 'Resources\EmployeeIdentifier',
    properties: [
        new OAT\Property(
            property: 'identifier',
            description: 'Employee UUID identifier.',
            type: 'string',
            format: 'uuid',
        ),
    ],
)]
class EmployeeIdentifier extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'identifier' => $this->resource->getIdentifier(),
        ];
    }
}
