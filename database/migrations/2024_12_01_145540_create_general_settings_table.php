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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('date_format')->nullable();
            $table->unsignedBigInteger('default_currency')->nullable();
            $table->foreign('default_currency')->references('id')
                ->on('currencies')->onDelete('set null');
            $table->string('timezone')->nullable();
            $table->boolean('maintenance_mode')->default(false);
            $table->string('language')->default('en');
            $table->integer('session_timeout')->default(30);
            $table->string('copyright')->nullable();
            $table->string('developed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
