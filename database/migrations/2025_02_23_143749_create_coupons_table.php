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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_value', 10, 2);
            $table->dateTime('expiry_date')->nullable();
            $table->integer('usage_limit')->nullable(); // NULL = unlimited
            $table->integer('used_count')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['active', 'expired', 'used'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
