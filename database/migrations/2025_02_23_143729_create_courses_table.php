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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_full_name');
            $table->string('slug')->unique();
            $table->string('course_short_name')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('course_categories')->onDelete('set null'); 
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
