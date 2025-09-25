<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('input_format', ['dropdown', 'checkbox']);
            $table->enum('second_input', ['yes', 'no'])->default('no');
            $table->string('second_input_label')->nullable(); // label if second_input = yes
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('price_labels');
    }
}
