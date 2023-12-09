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

        $rate_per_hour_and_cup = $this->faker->randomFloat(2, 1, 5);
        $price_per_hour_and_cup = $this->faker->randomFloat(2, 10, 50);


        $totalAmount = match ($paymentType) {
            'CupPayment' => $rate_per_hour_and_cup * $price_per_hour_and_cup,
            'ContractPayment' => $this->faker->randomFloat(2, 1000, 5000),
            'HourlyPayment' => $price_per_hour_and_cup * $price_per_hour_and_cup,
        };

        return [
            'workshop_id' => Workshop::factory(),
            'payment_type' => $paymentType,
            '$rate_per_hour_and_cup' => $rate_per_hour_and_cup,
            'price_per_hour_and_cup' => $price_per_hour_and_cup,
            'total_amount' => $totalAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ];


    }

}
