<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use OpenApi\Attributes as OAT;
use App\Http\Resources\BusinessTripItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use UseCases\BusinessTrip\GetEmployeeBusinessTrips;
use App\Http\Requests\IndexEmployeeBusinessTripRequest;
use App\Http\Requests\StoreEmployeeBusinessTripRequest;
use UseCases\BusinessTrip\CreateNewEmployeeBusinessTrip;
use App\Http\Controllers\Api\Controller as BaseController;

final class EmployeeBusinessTripController extends BaseController
{
    #[OAT\Get(
        path: '/api/employee/{employee}/business-trip',
        operationId: 'employee.business-trip.index',
        summary: 'Get Business Trip list for Employee',
        security: [],
        parameters: [
            new OAT\Parameter(
                parameter: 'Path\EmployeeIdentifier',
                name: 'employee',
                description: 'Employee UUID identifier.',
                in: 'path',
                required: true,
                schema: new OAT\Schema(
                    type: 'uuid',
                ),
            ),
        ],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Success.',
                content: new OAT\JsonContent(properties: [
                    new OAT\Property(
                        property: 'data',
                        type: 'array',
                        /* @see BusinessTripItem */
                        items: new OAT\Items(ref: '#/components/schemas/Resources\BusinessTripItem'),
                    ),
                ]),
            ),
        ],
    )]
    public function index(
        IndexEmployeeBusinessTripRequest $request,
        Employee $employee,
        GetEmployeeBusinessTrips $get_employee_business_trips
    ): JsonResource {
        $business_trips = $get_employee_business_trips->get($request);

        return BusinessTripItem::collection($business_trips);
    }

    #[OAT\Post(
        path: '/api/employee/{employee}/business-trip',
        operationId: 'employee.business-trip.store',
        summary: 'Add new Business Trip for Employee',
        security: [],
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/Requests\StoreEmployeeBusinessTrip'),
        ),
        parameters: [
            new OAT\Parameter(
                parameter: 'Path\EmployeeIdentifier',
                name: 'employee',
                description: 'Employee UUID identifier.',
                in: 'path',
                required: true,
                schema: new OAT\Schema(
                    type: 'uuid',
                ),
            ),
        ],
        responses: [
            new OAT\Response(
                response: 201,
                description: 'Success.',
                content: new OAT\JsonContent(properties: []),
            ),
        ],
    )]
    public function store(
        StoreEmployeeBusinessTripRequest $request,
        Employee $employee,
        CreateNewEmployeeBusinessTrip $create_new_employee_business_trip
    ): JsonResponse {
        $create_new_employee_business_trip->create($request);

        return response()->json([], 201);
    }
}
