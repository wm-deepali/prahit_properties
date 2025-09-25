<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('slug', ['Banner', 'Hand-Picked', 'Trending-Projects', 'Latest-Properties', 'Featured-Property', 'Real-Estate', 'New-Projects'])->nullable();
            $table->string('heading')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('ids')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('front_contents');
    }
}
