<?php

use App\Enums\BkashTransactionStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bkash_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('bkash_transactionable_id')->unsigned();
            $table->string('bkash_transactionable_type');
            $table->float('amount');
            $table->string('paymentCreateTime');
            $table->string('paymentExecuteTime')->nullable();
            $table->string('currency');
            $table->string('payerReference')->nullable();
            $table->string('customerMsisdn')->nullable();
            $table->string('intent');
            $table->string('merchantInvoiceNumber');
            $table->string('paymentID')->unique();
            $table->enum('transactionStatus', BkashTransactionStatus::toArray());
            $table->string('trxID')->nullable();
            $table->string('refundTime')->nullable();
            $table->string('refundTrxID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_transactions');
    }
};