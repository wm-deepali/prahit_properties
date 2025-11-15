<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_feature_settings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_id');
            $table->string('field_key');              // field key from form JSON
            $table->string('label_to_show')->nullable(); 
            $table->string('icon_class')->nullable(); // icon selected by admin
            $table->integer('sort_order')->default(0);
            $table->boolean('show_in_front')->default(0);

            $table->timestamps();

            // FK
            // $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_feature_settings');
    }
};
