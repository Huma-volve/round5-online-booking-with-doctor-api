<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
=======

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
<<<<<<< HEAD
            $table->boolean('is_active')->default(true); 
=======
            $table->boolean('is_active')->default(true);
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('type', ['admin', 'doctor', 'customer']);
>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
<<<<<<< HEAD
    public function down(): void
    {
=======

    public function down(): void {

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
