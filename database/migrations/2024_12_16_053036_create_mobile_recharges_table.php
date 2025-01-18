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
        Schema::create('mobile_recharges', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('mobile_number', 15);
            $table->decimal('amount', 10, 2);
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->string('operator', 50);
            $table->string('circle', 50);
            $table->string('type')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('recharged_at')->nullable();
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_recharges');
    }
};
