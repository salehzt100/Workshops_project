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
        Schema::create('employee_overtimes', function (Blueprint $table) {
            $table->id();
            $table->enum('employee_financial_type', ['award', 'overtime']);
            $table->foreignId('employee_id')->onDelete('cascade');
            $table->decimal('hours_worked', 5, 2);
            $table->decimal('rate_per_hour', 10, 2);
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_overtimes');
    }
};




