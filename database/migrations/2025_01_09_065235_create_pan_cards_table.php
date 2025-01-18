<?php

use App\Enums\FormStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pan_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('unique_id')->unique();
            $table->enum('application_mode', ['EKYC', 'ESIGN']);
            $table->enum('application_type', ['49A', 'CR']);
            $table->string('acknowledgement_no')->nullable();
            $table->enum('category', ['P']);
            $table->string('branch_code')->nullable();
            $table->string('name');
            $table->enum('gender', ['M', 'F', 'T']);
            $table->string('mobile');
            $table->string('email');
            $table->enum('pan_type', ['Y', 'N']);
            $table->string('consent')->default('Y');

            $table->double('transaction_fee')->default(0);

            // Response fields
            $table->string('order_id')->nullable();
            $table->text('authorization')->nullable();
            $table->timestamp('authorization_at')->nullable();
            $table->string('message')->nullable();

            // Status field with a default value
            $table->string('status')->default(FormStatus::STATUS_PENDING);

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pan_cards');
    }
};
