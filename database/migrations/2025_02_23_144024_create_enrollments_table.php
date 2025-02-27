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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Nullable for non-registered users
            $table->string('email')->nullable();
            $table->string('alt_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->enum('type', ['direct', 'custom_payment'])->default('direct'); // Default to 'direct'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
