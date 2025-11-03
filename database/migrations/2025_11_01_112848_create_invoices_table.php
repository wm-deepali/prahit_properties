<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            
            $table->string('invoice_number')->unique(191); // e.g. INV-2025-0001
            $table->date('invoice_date');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('currency', 10)->default('INR');
            
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            
            $table->string('billing_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->text('billing_address')->nullable();
            
            $table->enum('status', ['paid', 'unpaid', 'cancelled'])->default('paid');
            $table->string('invoice_file')->nullable(); // Optional PDF path

            $table->timestamps();

            // Foreign keys
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('set null');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
