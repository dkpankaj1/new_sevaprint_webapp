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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();

            $table->string('achievements_one_title')->nullable();
            $table->string('achievements_one_description')->nullable();
            $table->string('achievements_one_icon')->nullable();
            $table->string('achievements_one_count')->nullable();

            $table->string('achievements_two_title')->nullable();
            $table->string('achievements_two_description')->nullable();
            $table->string('achievements_two_icon')->nullable();
            $table->string('achievements_two_count')->nullable();

            $table->string('achievements_three_title')->nullable();
            $table->string('achievements_three_description')->nullable();
            $table->string('achievements_three_icon')->nullable();
            $table->string('achievements_three_count')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
