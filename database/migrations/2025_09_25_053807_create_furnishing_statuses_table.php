<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('furnishing_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('input_format', ['dropdown', 'checkbox']);
            $table->enum('second_input', ['yes', 'no'])->default('no');
            $table->string('second_input_label')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furnishing_statuses');
    }
};
