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

        $workshop=Workshop::factory()->create();
        $workshop_type = $workshop->workshop_type;

        $rate_per_hour_and_cup = $this->faker->randomFloat(2, 1, 5);
        $price_per_hour_and_cup = $this->faker->randomFloat(2, 10, 50);


        $totalAmount = match ($workshop_type) {
            'sellingAggregate', 'transportation' => $rate_per_hour_and_cup * $price_per_hour_and_cup,
            'workshop' => $this->faker->randomFloat(2, 1000, 5000)
        };
        return [
            'payment_type'=>$this->faker->randomElement(['CupPayment', 'ContractPayment', 'HourlyPayment']),
            'workshop_id' => $workshop->id,
            'rate_per_hour_and_cup' => $rate_per_hour_and_cup,
            'price_per_hour_and_cup' => $price_per_hour_and_cup,
            'total_amount' => $totalAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ];



    }

}
