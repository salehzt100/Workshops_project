<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'national_id' => $this->faker->unique()->randomNumber(8),
            'phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'salary' => $this->faker->randomFloat(2, 1000, 5000),
        ];
    }
}
