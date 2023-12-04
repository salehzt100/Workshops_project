<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicles_name' => $this->faker->word,
            'full_vehicles_price' => $this->faker->randomFloat(2, 10000, 50000),
            'vehicle_type' => $this->faker->word,
            'vehicles_number_or_identifier' => $this->faker->word,
            'total_amount_paid_so_far' => $this->faker->randomFloat(2, 0, 50000),
            'amount_paid_in_cash' => $this->faker->randomFloat(2, 0, 50000),
            'amount_paid_by_checks' => $this->faker->randomFloat(2, 0, 50000),
            'remaining_amount' => $this->faker->randomFloat(2, 0, 50000),
            'sale_status' => $this->faker->word,
            'sale_price' => $this->faker->randomFloat(2, 0, 50000),

        ];

    }
}
