<?php

declare(strict_types=1);

namespace Tests\Smoke\app\Http\Controllers\Api\EmployeeController\Store;

trait EmployeeControllerTrait
{
    public function getExpectedJsonStructure(): array
    {
        return [
            'data' => [
                'identifier',
            ],
        ];
    }
}
