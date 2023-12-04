<?php

namespace Database\Seeders;
use App\Models\checks;
use App\Models\EmployeeOvertime;
use App\Models\Employee;
use App\Models\Expenses;
use App\Models\GasStation;
use App\Models\GasStationRefill;
use App\Models\Owners;
use App\Models\Payments;
use App\Models\VehicleIncomes;
use App\Models\Vehicles;
use App\Models\WorkshopFinancialProcess;
use App\Models\Workshops;
use App\Models\WorkshopVehicles;
use Database\Factories\workshopFinancialProcessFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Payments::factory(10)->create();

        // There is no need to call  factory()->create()   for thees tables

        /*        Employee::factory(4)->create();
                EmployeeOvertime::factory(4)->create();
                checks::factory(4)->create();
                Expenses::factory(4)->create();
                GasStation::factory(4)->create();
                GasStationRefill::factory(4)->create();
                Owners::factory(4)->create();
                Payments::factory(4)->create();
                VehicleIncomes::factory(4)->create();
                Workshops::factory(4)->create();
                WorkshopVehicles::factory(4)->create();
                WorkshopFinancialProcess::factory(4)->create();
        */

    }
}
