<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_listing_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable(); // No foreign key constraint
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('rating'); // 1 to 5
            $table->text('comment');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('business_listing_reviews');
    }

}
