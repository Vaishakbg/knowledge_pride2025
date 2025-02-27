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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('code', 3)->unique(); // Currency code (USD, INR, EUR)
            $table->string('symbol', 10); // Currency symbol ($, ₹, €)
            $table->decimal('rate', 10, 2)->default(1.00); // Conversion rate (default: 1.00)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
