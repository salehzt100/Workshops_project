<?php

namespace Database\Factories;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkshopFinancialProcess>
 */
class WorkshopFinancialProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentType = $this->faker->randomElement(['CupPayment', 'ContractPayment', 'HourlyPayment']);

        $hoursWorked = $this->faker->randomFloat(2, 1, 5);
        $pricePerCup = $this->faker->randomFloat(2, 10, 50);
        $hourlyRate = $this->faker->randomFloat(2, 20, 100);
        $cupCount = $this->faker->numberBetween(1, 10);

        $totalAmount = match ($paymentType) {
            'CupPayment' => $cupCount * $pricePerCup,
            'ContractPayment' => $this->faker->randomFloat(2, 1000, 5000),
            'HourlyPayment' => $hoursWorked * $hourlyRate,
        };

        return [
            'workshop_id' => Workshop::factory(),
            'payment_type' => $paymentType,
            'cup_count' => $cupCount,
            'price_per_cup' => $pricePerCup,
            'hourly_rate' => $hourlyRate,
            'hours_worked' => $hoursWorked,
            'total_amount' => $totalAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }

}
