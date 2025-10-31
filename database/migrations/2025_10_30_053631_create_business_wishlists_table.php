<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_listing_id');
            $table->timestamps();

            // Optional indexes (no foreign keys to keep it flexible)
            $table->index('user_id');
            $table->index('business_listing_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_wishlists');
    }
};
