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
            $table->unsignedBigInteger('check_id')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('employeeOvertimeId')->nullable();
            $table->unsignedBigInteger('EmployeeId')->nullable();
            $table->unsignedBigInteger('stationRefillId')->nullable();
            $table->unsignedBigInteger('ExpensesId')->nullable();
            $table->unsignedBigInteger('vehicleIncomeId')->nullable();
            $table->unsignedBigInteger('workshopFinancialProcessID')->nullable();
            $table->string('note', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};




