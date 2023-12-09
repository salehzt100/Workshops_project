<?php

namespace Database\Factories;

use App\Models\Vehicles;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkshopVehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workshop_id'=>Workshop::factory(),
            'vehicle_id'=>Vehicles::factory()
        ];
    }
}
