<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_name' => $this->faker->word,
            'full_vehicles_price' => $this->faker->randomFloat(2, 10000, 50000),
            'vehicle_type' => $this->faker->word,
            'vehicles_number_or_identifier' => $this->faker->word,
            'sale_status' => $this->faker->randomELement(['sold','unsold']),
            'sale_price' => $this->faker->randomFloat(2, 0, 50000),
        ];

    }
}
