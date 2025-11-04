<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Related to business profile
            $table->unsignedBigInteger('profile_section_id');
            $table->foreign('profile_section_id')
                ->references('id')
                ->on('profile_sections')
                ->onDelete('cascade');

            // Optional user relation (if logged in)
            $table->unsignedBigInteger('user_id')->nullable();
            // Review details
            $table->string('name', 100);
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->tinyInteger('rating')->unsigned(); // 1–5 stars
            $table->text('comment');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
