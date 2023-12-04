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
            $table->string('workshops_name');
            $table->enum('workshop_type', ['sellingAggregate','transportation','workshop']);
            $table->integer('desired_amount')->defult(0);
            $table->float('cash_payments')->defult(0);
            $table->float('check_payments')->defult(0);
            $table->float('remaining_balance', 10, 2);
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
