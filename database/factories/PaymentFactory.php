<?php

namespace Database\Factories;

use App\Models\checks;
use App\Models\Employee;
use App\Models\EmployeeOvertime;
use App\Models\Expense;
use App\Models\Vehicle;
use App\Models\VehicleIncome;
use App\Models\Workshop;
use App\Models\WorkshopFinancialProcess;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{

    public function definition(): array
    {
        return [

            'payment_type' => $this->faker->randomElement(['employeeOvertime','vehicleCost', 'employeeSalary', 'stationRefill', 'Expenses', 'vehicleIncome', 'workshopFinancialProcess']),
            'amount_type' => $this->faker->randomElement(['cash', 'check']),
            'check_id' =>  checks::factory(),
            'employee_overtime_id' => EmployeeOvertime::factory(),
            'employee_id' => Employee::factory(),
            'expenses_id' => Expense::factory(),
            'vehicle_income_id' =>VehicleIncome::factory() ,
            'workshop_id' =>Workshop::factory(),
            'vehicle_id'=>Vehicle::factory(),
            'amount'=>$this->faker->randomNumber(4),
            'note' => $this->faker->sentence,
        ];


    }
}
