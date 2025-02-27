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
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Nullable for guests
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message');
            $table->enum('type', ['general', 'callback', 'support', 'sales'])->default('general');
            $table->enum('status', ['pending', 'resolved', 'spam'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
