<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;


class WorkshopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
/*        $CashPayments = $this->faker->numberBetween(500, 1500);
        $CheckPayments = $this->faker->numberBetween(500, 1500);
        $RemainingBalance=$this->faker->numberBetween(500, 1500);
        'desired_amount' => $CheckPayments + $CashPayments +$RemainingBalance,
            'cash_payments' => $CashPayments,
            'check_payments' => $CheckPayments,
            'remaining_balance' => $RemainingBalance,*/

        return [
            'owner_id' => Owner::factory(),
            'workshop_name' => $this->faker->word,
            'workshop_type' => $this->faker->randomElement(['sellingAggregate', 'transportation', 'workshop']),
            'count_employees'=> $this->faker->numberBetween(1,30),
            'status'=>$this->faker->randomElement(['completed','uncompleted'])
        ];

    }
}