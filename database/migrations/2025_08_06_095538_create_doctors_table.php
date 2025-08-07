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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_image')->nullable(); // path to image
            $table->string('phone');
            $table->string('email')->unique();
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');            $table->text('bio')->nullable();
            $table->json('available_slots')->nullable(); // We'll store slots as JSON
            $table->boolean('status')->default(true); // true = active, false = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
