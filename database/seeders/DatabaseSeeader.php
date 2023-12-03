<?php

namespace Database\Seeders;

use App\Models\EmployeeOvertime;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->create();
        EmployeeOvertime::factory(10)->create([

        ]);
    }
}
