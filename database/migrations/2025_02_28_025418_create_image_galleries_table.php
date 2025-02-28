<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Reference to courses
            $table->string('title', 100);
            $table->text('caption')->nullable();
            $table->string('image_path', 255); // Store one image, generate sizes dynamically
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_galleries');
    }
};

