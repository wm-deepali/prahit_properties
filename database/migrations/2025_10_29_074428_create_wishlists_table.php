<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // Just store user and property IDs — no foreign key constraints
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');

            $table->timestamps();

            // Prevent duplicate wishlist entries for same user + property
            $table->unique(['user_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
