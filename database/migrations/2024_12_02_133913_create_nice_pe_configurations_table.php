<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nice_pe_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('logo')->nullable();
            $table->string('upi_id')->nullable(false);
            $table->string('token')->nullable(false);
            $table->string('secret_key')->nullable(false);
            $table->string('base_url')->nullable(false);
            $table->boolean('enable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nice_pe_configurations');
    }
};
