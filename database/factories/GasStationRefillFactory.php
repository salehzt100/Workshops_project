<?php

namespace Database\Factories;

use App\Models\GasStation;
use App\Models\GasStationRefill;

use Illuminate\Database\Eloquent\Factories\Factory;

class GasStationRefillFactory extends Factory
{

    public function definition(): array
    {
        return [
            'gas_station_id'=> GasStation::factory(),
            'transaction_date'=>  $this->faker->date,
            'amount'=>   $this->faker->randomFloat(2,10000,20000) ,
            'notes'=>   $this->faker->sentence
        ];

    }
}
