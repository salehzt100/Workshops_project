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
            'salary' => $this->faker->randomFloat(2, 1000, 5000),
            'total_advances' => $this->faker->randomFloat(2, 0, 1000),
        ];

    }
}
