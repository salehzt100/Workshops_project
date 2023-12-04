<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class checksFactory extends Factory
{

    public function definition(): array
    {

        return [
            'amount'=> $this->faker->randomFloat(2,1000,300),
            'dueDate'=>$this->faker->dateTimeBetween('+2 months', '+15 months'),
            'owner'=> $this->faker->name,
        ];

    }
}
