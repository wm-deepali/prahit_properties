<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Initial migration: create table without foreign keys
        Schema::create('business_listing_sub_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_listing_id');
            $table->unsignedBigInteger('web_directory_sub_category_id');
            $table->timestamps();
        });

        // Later migration: add foreign keys
        Schema::table('business_listing_sub_category', function (Blueprint $table) {
            $table->foreign('business_listing_id', 'bl_fk')
                ->references('id')->on('business_listings')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('business_listing_sub_category', function (Blueprint $table) {
            $table->dropForeign('bl_fk');
            $table->dropForeign('bl_sub_fk');
        });

        Schema::dropIfExists('business_listing_sub_category');
    }
};

