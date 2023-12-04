<?php

namespace Database\Factories;
use App\Models\WorkshopVehicles;
use Illuminate\Database\Eloquent\Factories\Factory;


class VehicleIncomesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $hours_worked = $this->faker->randomFloat(2, 1, 15);
        $hourly_rate = $this->faker->randomFloat(0, 15, 30);
        return [
            'workshop_vehicles_id' => WorkshopVehicles::factory(),
            'hours_worked' => $hours_worked,
            'hourly_rate' => $hourly_rate,
            'date' => $this->faker->date,
            'income'=>$hours_worked*$hourly_rate

        ];
    }
}
