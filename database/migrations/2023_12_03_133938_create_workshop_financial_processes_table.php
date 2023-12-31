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
        Schema::create(/**
         * @param Blueprint $table
         * @return void
         */ 'workshop_financial_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workshop_id');
            $table->enum('payment_type', ['CupPayment', 'ContractPayment', 'HourlyPayment']);
            $table->integer('cup_count')->nullable;
            $table->decimal('price_per_cup', 10, 2)->nullable;
            $table->decimal('hourly_rate', 10, 2)->nullable;
            $table->decimal('hours_worked', 5, 2)->nullable;


            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_financial_processes');
    }
};
