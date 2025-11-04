<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('business_name')->nullable();
            $table->string('rera_number')->nullable();
            $table->string('operating_since')->nullable();
            $table->integer('years_experience')->nullable();
            $table->string('deals_in')->nullable(); // comma separated
            $table->text('description')->nullable();
            $table->json('services')->nullable(); // for the dynamic services section
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_sections');
    }
};
