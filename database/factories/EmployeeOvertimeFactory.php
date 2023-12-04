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
        $hours_worked = $this->faker->randomFloat(0, 1, 15);
        $hourlyRate = $this->faker->randomFloat(2, 20, 50);
        $employeeFinancialType=$this->faker->randomElement(['advance', 'overtime']);

        $amount = match ($employeeFinancialType) {
            'overtime' => $hourlyRate * $hours_worked,
            'advance' => $this->faker->randomFloat(2, 1000, 2000),
        };
        return [
            'employee_id' => Employee::factory()->create()->id,
            'employeeFinancialType'=>$employeeFinancialType,
            'date' => $this->faker->date,
            'hours_worked' => $hours_worked ,
            'rate_per_hour' => $hourlyRate,
            'amount' => $amount
        ];

    }
}
