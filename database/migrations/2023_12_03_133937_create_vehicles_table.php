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
            $table->string('vehicle_name');
            $table->decimal('full_vehicles_price', 10, 2);
            $table->string('vehicle_type');
            $table->string('vehicles_number_or_identifier', 50);
            $table->enum('sale_status', ['sold','unsold'])->default('unsold');
            $table->decimal('sale_price', 10, 2)->default(0);
            $table->timestamps();
        });


    }


    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
