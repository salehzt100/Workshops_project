<?php

namespace Database\Factories;

use App\Models\Owners;
use App\Models\Workshops;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GasStation>
 */
class GasStationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'owner_id'=>Owners::factory(),
            'workshop_id'=>Workshops::factory(),
            'current_balance'=> $this->faker->numberBetween(10000,20000)
        ];
    }
}
