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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id');
            $table->string('WorkshopsName');
            $table->enum('WorkshopType', ['sellingAggregate','transportation','workshop']);
            $table->decimal('TotalEarnings', 10, 2)->defult(0);
            $table->decimal('CashPayments', 10, 2)->defult(0);
            $table->decimal('CheckPayments', 10, 2)->defult(0);
            $table->decimal('RemainingBalance', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
