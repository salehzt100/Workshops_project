<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleWorkshopsFactory extends Factory
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
            'vehicle_id'=>Vehicle::factory()
        ];
    }
}
