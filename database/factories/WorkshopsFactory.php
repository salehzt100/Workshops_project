<?php

namespace Database\Factories;

use App\Models\Owners;
use Illuminate\Database\Eloquent\Factories\Factory;


class WorkshopsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $CashPayments = $this->faker->numberBetween(500, 1500);
        $CheckPayments = $this->faker->numberBetween(500, 1500);
        $RemainingBalance=$this->faker->numberBetween(500, 1500);

        return [
            'owner_id' => Owners::factory(),
            'workshops_name' => $this->faker->word,
            'workshop_type' => $this->faker->randomElement(['sellingAggregate', 'transportation', 'workshop']),
            'total_earnings' => $CheckPayments + $CashPayments +$RemainingBalance,
            'cash_payments' => $CashPayments,
            'check_payments' => $CheckPayments,
            'remaining_balance' => $RemainingBalance
        ];

    }
}
