
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['employeeOvertime', 'employeeSalary', 'stationRefill', 'Expenses', 'vehicleIncome', 'workshopFinancialProcess']);
            $table->enum('amount_type', ['cash', 'check']);
            $table->date('date');
            $table->foreignId('check_id')->nullable();
            $table->foreignId('employee_overtime_id')->nullable();
            $table->foreignId('employee_id')->nullable()->onDelete('cascade');
            $table->foreignId('gas_station_refill_id')->nullable();
            $table->foreignId('expenses_id')->nullable();
            $table->foreignId('vehicle_income_id')->nullable();
            $table->foreignId('workshop_financial_process_id')->nullable();
            $table->string('note', 255);
            $table->integer('amount');
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




