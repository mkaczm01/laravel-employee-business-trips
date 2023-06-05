<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OAT;
use Illuminate\Http\JsonResponse;
use UseCases\Employee\CreateEmployee;
use App\Http\Resources\EmployeeIdentifier;

final class EmployeeController extends Controller
{
    #[OAT\Post(
        path: '/api/employee',
        operationId: 'employee.store',
        summary: 'Add new Employee',
        security: [],
        parameters: [],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Success.',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(
                        property: 'data',
                        /* @see EmployeeIdentifier */
                        ref: '#/components/schemas/Resources\EmployeeIdentifier',
                        type: 'object'
                    ),
                ]),
            ),
        ],
    )]
    public function store(
        CreateEmployee $create_employee
    ): JsonResponse {
        $created_employee = $create_employee->create();

        return (new EmployeeIdentifier($created_employee))
            ->response()
            ->setStatusCode(201)
        ;
    }
}
