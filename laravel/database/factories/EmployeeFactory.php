<?php

declare(strict_types=1);

namespace Database\Factories;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Uuid::uuid4(),
        ];
    }
}
