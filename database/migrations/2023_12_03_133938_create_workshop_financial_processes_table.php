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
        Schema::create( 'workshop_financial_processes', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['CupPayment', 'ContractPayment', 'HourlyPayment']);
            $table->foreignId('workshop_id');
            $table->decimal('price_per_hour_and_cup', 10, 2)->nullable();
            $table->decimal('rate_per_hour_and_cup', 10, 2)->nullable();
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
