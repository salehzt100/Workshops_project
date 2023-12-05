<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['employeeOvertime', 'employeeSalary', 'stationRefill', 'Expenses', 'vehicleIncome', 'workshopFinancialProcess']);
            $table->enum('amount_type', ['cash', 'check']);
            $table->date('date');
            $table->foreinId('check_id')->nullable();
            $table->foreinId('employeeOvertimeId')->nullable();
            $table->foreinId('EmployeeId')->nullable();
            $table->foreinId('stationRefillId')->nullable();
            $table->foreinId('ExpensesId')->nullable();
            $table->foreinId('vehicleIncomeId')->nullable();
            $table->foreinId('workshopFinancialProcessID')->nullable();
            $table->string('note', 255);
            $table->timestamps();
        });
    }


    ///
    ///
    ///
    ///
    ///
    ///
    ///
    ///

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};




