<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPropertySubSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('business_property_sub_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_listing_id')
                  ->constrained('business_listings')
                  ->onDelete('cascade');
            $table->foreignId('sub_sub_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_property_sub_subcategories');
    }
}
