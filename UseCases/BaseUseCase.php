<?php

declare(strict_types=1);

namespace UseCases;

abstract class BaseUseCase
{
    public function __construct(
        protected readonly DomainServiceFactory $domain_service_factory
    ) {
    }
}
