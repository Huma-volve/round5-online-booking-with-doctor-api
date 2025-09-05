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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // patient
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // doctor from doctors table
            $table->date('date'); // appointment date
            $table->time('time'); // appointment time
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
