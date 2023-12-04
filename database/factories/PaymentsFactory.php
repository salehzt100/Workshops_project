<?php

namespace Database\Factories;

use App\Models\checks;
use App\Models\Employee;
use App\Models\EmployeeOvertime;
use App\Models\Expenses;
use App\Models\GasStationRefill;
use App\Models\VehicleIncomes;
use App\Models\WorkshopFinancialProcess;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentsFactory extends Factory
{

    public function definition(): array
    {
        return [

            'payment_type' => $this->faker->randomElement(['employeeOvertime', 'employeeSalary', 'stationRefill', 'Expenses', 'vehicleIncome', 'workshopFinancialProcess']),
            'amount_type' => $this->faker->randomElement(['cash', 'check']),
            'date' => $this->faker->date(),
            'check_id' =>  checks::factory(),
            'employee_overtime_id' => EmployeeOvertime::factory(),
            'employee_id' => Employee::factory(),
            'gas_station_refill_id' => GasStationRefill::factory(),
            'expenses_id' => Expenses::factory(),
            'vehicle_income_id' =>VehicleIncomes::factory() ,
            'workshop_financial_process_id' =>WorkshopFinancialProcess::factory(),
            'amount'=>$this->faker->randomNumber(4),
            'note' => $this->faker->sentence,
        ];


    }
}
