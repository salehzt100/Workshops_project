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
        Schema::create('vehicle_incomes', function (Blueprint $table) {

            $table->id();
            $table->foreignId('workshop_vehicles_id');
            $table->decimal('hours_worked', 5, 2);
            $table->decimal('income', 10, 2);
            $table->date('date');
            $table->decimal('hourly_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles_income');
    }
};
