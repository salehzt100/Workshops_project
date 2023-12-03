<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeOvertime>
 */
class EmployeeOvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'date' => $this->faker->date,
            'hours_worked' => $this->faker->randomFloat(2, 1, 10),
            'rate_per_hour' => $this->faker->randomFloat(2, 15, 30),
            'amount' => $this->faker->randomFloat(2, 50, 300)
        ];
    }
}
