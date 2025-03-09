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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->string('currency');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->enum('type', ['classroom', 'online', 'hybrid'])->default('classroom');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('std_price', 10, 2)->default(0);
            $table->decimal('eb_price', 10, 2)->nullable();
            $table->date('eb_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('map')->nullable();
            $table->unsignedInteger('no_of_participants')->default(0);
            $table->boolean('is_active')->default(true); // Changed status to is_active
            $table->enum('schedule_status', ['upcoming', 'ongoing', 'completed', 'cancelled'])
                ->default('upcoming'); // New column for status tracking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
