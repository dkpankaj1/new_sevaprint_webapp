<?php

use App\Enums\TransactionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_type')->comment('internal or external');
            $table->enum('transaction_direction', ['credit', 'debit'])->comment('credit: increase balance, debit: decrease balance');
            $table->string('vendor')->default(TransactionEnum::VENDOR_INTERNAL);
            $table->string('transaction_id')->nullable()->comment('External reference ID');
            $table->decimal('opening_balance', 15, 2)->comment('Balance before the transaction');
            $table->decimal('amount', 15, 2)->comment('Transaction amount');
            $table->decimal('fee', 15, 2)->default(0.00)->comment('Transaction fee');
            $table->decimal('tax', 15, 2)->default(0.00)->comment('Applicable tax');
            $table->decimal('closing_balance', 15, 2)->comment('Balance after the transaction');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->string('payment_method')->nullable()->comment('Payment method used.wallet,card,upi,etc');
            $table->string('status')->default('pending')->comment('Transaction status');
            $table->json('metadata')->nullable()->comment('Additional transaction details');
            $table->string('ip_address')->nullable()->comment('User IP address');
            $table->string('user_agent')->nullable()->comment('User agent details');
            $table->timestamp('processed_at')->nullable()->comment('Transaction processed at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
