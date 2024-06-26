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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('drug_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 8, 2);
            $table->decimal('total_price', 12, 2);
            $table->string('currency')->default('IDR');
            $table->string('prescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
