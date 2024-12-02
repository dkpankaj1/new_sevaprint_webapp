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
            $table->string('code', 3);                         // ISO currency code (e.g., USD, EUR)
            $table->string('name');                            // Currency name (e.g., US Dollar)
            $table->string('symbol')->nullable();              // Currency symbol (e.g., $, €)
            $table->decimal('exchange_rate', 15, 6)->default(1); // Exchange rate relative to the base currency
            $table->boolean('is_active')->default(true);       // Flag to indicate if the currency is active
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
