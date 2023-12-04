<?php

namespace Database\Factories;

use App\Models\GasStation;
use App\Models\Vehicles;
use App\Models\Workshops;
use App\Models\WorkshopVehicles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesFactory extends Factory
{

    public function definition(): array
    {
        return [
            'expenseType' => $this->faker->randomElement(['operational', 'fuelWithdraw', 'fuelCash', 'maintenance', 'LubricantsOils']),
            'amount' => $this->faker->numberBetween(100, 10000),
            'date' => $this->faker->date(),
            'vehicle_id' => Vehicles::factory(),
            'Gas_station_id' => GasStation::factory(),
            'workshop_id' => Workshops::factory(),
            'workshop_vehicle_id' => WorkshopVehicles::factory(),
            'person_name' => $this->faker->name,
            'notes' => $this->faker->sentence,
        ];
    }
}
