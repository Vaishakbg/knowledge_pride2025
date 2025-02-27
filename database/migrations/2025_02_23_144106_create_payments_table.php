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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->nullable()->constrained('enrollments')->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['paypal', 'stripe', 'razorpay', 'bank_transfer', 'ccavenue', 'cheque', 'other']);
            $table->string('transaction_id')->nullable(); // Unique Transaction ID
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->decimal('discount', 10, 2)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
