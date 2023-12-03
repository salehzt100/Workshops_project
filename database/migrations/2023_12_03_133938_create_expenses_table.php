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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->enum('expenseType', ['operational', 'fuelWithdraw', 'fuelCash', 'maintenance', 'LubricantsOils']);
            $table->integer('amount');
            $table->date('date');
            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('station_id')->nullable();
            $table->foreignId('workshop_id')->nullable();
            $table->foreignId('workshop_vehicle_id')->nullable();
            $table->string('person_name', 255);
            $table->string('notes', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
