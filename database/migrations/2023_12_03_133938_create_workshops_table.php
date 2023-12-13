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
            $table->string('workshop_name');// default
            $table->enum('workshop_type', ['sellingAggregate','transportation','workshop']);
            $table->float('remaining_balance', 10, 2)->default(0);
            $table->integer('count_employees')->default(0);
            $table->enum('status',['completed','uncompleted'])->default('uncompleted');
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
