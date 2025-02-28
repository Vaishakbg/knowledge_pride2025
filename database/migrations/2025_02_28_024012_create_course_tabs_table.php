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
        Schema::create('course_tabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); 
            $table->string('title'); // Example: "Curriculum", "Instructor", "FAQ"
            $table->string('icon_class'); // Example: "fa fa-book", "fa fa-user", "fa fa-question"
            $table->longText('html_content'); // Store HTML content
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_tabs');
    }
};
