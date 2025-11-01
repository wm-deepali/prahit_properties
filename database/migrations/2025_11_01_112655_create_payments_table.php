<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Who made the payment
            $table->unsignedBigInteger('package_id')->nullable(); // Which package (optional)
            $table->unsignedBigInteger('subscription_id')->nullable(); // Which subscription it belongs to
            
            $table->string('payment_method')->nullable(); // e.g. Razorpay, Stripe, PayPal, Manual
            $table->string('transaction_id')->nullable(); // Gateway transaction reference
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('currency', 10)->default('INR');
            
            $table->enum('status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
            $table->json('payment_response')->nullable(); // store full response from gateway
            
            $table->timestamps();

            // Foreign keys
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
