<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Countries table with currency details
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code', 5)->unique(); // Country Code (e.g., "IN", "US")
            $table->string('currency_name')->nullable(); // Currency Name (e.g., "Indian Rupee")
            $table->string('currency_code', 5)->nullable(); // Currency Code (e.g., "INR", "USD")
            $table->string('currency_symbol', 10)->nullable(); // Currency Symbol (e.g., "₹", "$")
            $table->decimal('rate', 10, 2)->nullable(); // Currency Rate (e.g., 1 USD = 73.67 INR)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

