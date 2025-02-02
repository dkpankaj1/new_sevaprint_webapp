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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->double('fee')->default(0);
            $table->double('commission')->default(0);
            $table->tinyInteger('commission_type')->default(0);

            $table->boolean('enable')->default(true);
            $table->timestamps();

            $table->index(['code', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
