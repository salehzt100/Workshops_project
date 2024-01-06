
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
            $table->enum('payment_type', ['employeeOvertime', 'employeeSalary', 'employeeAdvance', 'stationRefill', 'Expenses', 'vehicleIncome', 'workshopFinancialProcess', 'vehicleCost']);
            // vehicle cost==  sell the vehicle
            $table->enum('amount_type', ['cash', 'check']);
            $table->integer('amount');
            $table->foreignId('check_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('employee_overtime_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->onDelete('cascade');
            $table->foreignId('expenses_id')->nullable();
            $table->foreignId('vehicle_income_id')->nullable();
            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('workshop_id')->nullable();
            $table->string('note', 255)->nullable();
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
