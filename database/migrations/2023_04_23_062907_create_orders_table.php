<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->float('order_total');
            $table->enum('order_status', OrderStatus::toArray())->default(OrderStatus::pendingPayment);
            $table->string('order_note')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('payment_method', PaymentMethod::toArray())->default(PaymentMethod::bkash);
            $table->enum('payment_status', PaymentStatus::toArray())->default(PaymentStatus::Unpaid);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};