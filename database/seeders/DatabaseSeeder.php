<?php

namespace Database\Seeders;
use App\Models\Checks;
use App\Models\EmployeeOvertime;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\GasStation;
use App\Models\GasStationRefill;
use App\Models\Owner;
use App\Models\Payment;
use App\Models\VehicleIncome;
use App\Models\Vehicle;
use App\Models\WorkshopFinancialProcess;
use App\Models\Workshop;
use App\Models\VehicleWorkshop;
use Database\Factories\workshopFinancialProcessFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Payment::factory(10)->create();

        // There is no need to call  factory()->create()   for thees tables

              Employee::factory(4)->create();
                EmployeeOvertime::factory(4)->create();
                Checks::factory(4)->create();
                Expense::factory(4)->create();
                GasStation::factory(4)->create();
                GasStationRefill::factory(4)->create();
                Owner::factory(4)->create();
                Payment::factory(4)->create();
                VehicleIncome::factory(4)->create();
                VehicleWorkshop::factory(4)->create();
                WorkshopFinancialProcess::factory(10)->create();

    }
}
