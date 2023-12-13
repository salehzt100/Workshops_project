<?php

namespace Database\Factories;

use App\Models\GasStation;
use App\Models\Vehicle;
use App\Models\Workshop;
use App\Models\VehicleWorkshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{

    public function definition(): array
    {
        return [
            'expenseType' => $this->faker->randomElement(['operational', 'fuelWithdraw', 'fuelCash', 'maintenance', 'LubricantsOils']),
            'amount' => $this->faker->numberBetween(100, 10000),
            'date' => $this->faker->date(),
            'vehicle_id' => Vehicle::factory(),
            'Gas_station_id' => GasStation::factory(),
            'workshop_id' => Workshop::factory(),
            'workshop_vehicle_id' => VehicleWorkshop::factory(),
            'person_name' => $this->faker->name,
            'notes' => $this->faker->sentence,
        ];
    }
}
