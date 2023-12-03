<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'national_id' => $this->faker->unique()->randomNumber(8),
            'phone' => $this->faker->phoneNumber,
            'salary' => $this->faker->randomFloat(2, 1000, 5000),
            'total_advances' => $this->faker->randomFloat(2, 0, 1000),
        ];

    }
}
