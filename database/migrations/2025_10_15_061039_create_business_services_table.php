<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('business_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_listing_id')->constrained('business_listings')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_services');
    }
};
