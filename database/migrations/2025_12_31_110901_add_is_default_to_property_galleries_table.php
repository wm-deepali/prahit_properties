<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDefaultToPropertyGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_gallery', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('image_path');
        });
    }

    public function down()
    {
        Schema::table('property_gallery', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }

}
