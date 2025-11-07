<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_working_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_listing_id')->constrained('business_listings')->onDelete('cascade');
            $table->string('day'); // Monday, Tuesday, etc.
            $table->time('start')->nullable(); // Start time
            $table->time('end')->nullable();   // End time
            $table->boolean('closed')->default(false); // Closed or open
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_working_hours');
    }
};
