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
            $table->string('VehiclesName');
            $table->decimal('FullVehiclesPrice', 10, 2);
            $table->string('VehicleType');
            $table->string('VehiclesNumberOrIdentifier', 50);
            $table->decimal('TotalAmountPaidSoFar', 10, 2);
            $table->decimal('AmountPaidInCash', 10, 2);
            $table->decimal('AmountPaidByChecks', 10, 2);
            $table->decimal('RemainingAmount', 10, 2)->defult(0);
            $table->string('SaleStatus', 50);
            $table->decimal('SalePrice', 10, 2);
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
