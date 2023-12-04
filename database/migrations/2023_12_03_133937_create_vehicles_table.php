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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicles_name');
            $table->decimal('full_vehicles_price', 10, 2);
            $table->string('vehicle_type');
            $table->string('vehicles_number_or_identifier', 50);
            $table->decimal('total_amount_paid_so_far', 10, 2);
            $table->decimal('amount_paid_in_cash', 10, 2);
            $table->decimal('amount_paid_by_checks', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->string('sale_status', 50);
            $table->decimal('sale_price', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
