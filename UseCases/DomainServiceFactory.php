<?php

declare(strict_types=1);

namespace UseCases;

use Illuminate\Support\Arr;
use Employee\EmployeeCommand;
use BusinessTrip\BusinessTripQuery;
use BusinessTrip\BusinessTripCommand;
use BusinessTrip\BusinessTripValidator;
use Contracts\Services\IEmployeeCommand;
use Contracts\Services\IBusinessTripQuery;
use Contracts\Services\IBusinessTripCommand;
use Contracts\Services\IBusinessTripValidator;
use Illuminate\Contracts\Foundation\Application;

class DomainServiceFactory
{
    protected array $bindings = [
        IEmployeeCommand::class => EmployeeCommand::class,
        IBusinessTripCommand::class => BusinessTripCommand::class,
        IBusinessTripQuery::class => BusinessTripQuery::class,
        IBusinessTripValidator::class => BusinessTripValidator::class,
    ];

    public function __construct(
        private readonly Application $app
    ) {
    }

    /**
     * @template T
     *
     * @param class-string<T> $interface
     *
     * @return T
     */
    public function create(string $interface): mixed
    {
        $service_class = Arr::get($this->bindings, $interface);

        try {
            if (!$service_class) {
                throw new \RuntimeException(__('No domain service is bound to interface.'));
            }

            return $this->app->make($service_class);
        } catch (\Throwable $throwable) {
            throw new \RuntimeException(message: 'Domain service exception', previous: $throwable);
        }
    }
}
