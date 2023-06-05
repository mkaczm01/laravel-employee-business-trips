<?php

declare(strict_types=1);

namespace Tests;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function fakeUuid(string $expected_uuid): void
    {
        Uuid::setFactory(new class($expected_uuid) extends UuidFactory {
            public function __construct(private readonly string $expected_uuid)
            {
                parent::__construct();
            }

            public function uuid4($node = null, ?int $clockSeq = null): UuidInterface
            {
                return Uuid::fromString($this->expected_uuid);
            }
        });
    }
}
