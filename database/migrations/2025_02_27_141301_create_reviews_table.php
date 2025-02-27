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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Changed 'Name' to lowercase
            $table->text('review');
            $table->foreignId('trainer_id')->nullable()->constrained('trainers')->onDelete('set null'); // Keeps review even if trainer is deleted
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('rating')->default(4)->comment('1 to 5'); // Ensure rating is between 1 to 5
            $table->boolean('is_approved')->default(false); // New field for approval
            $table->timestamps(); // If you want created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
