<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmenitiesToggleToSubSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('sub_sub_categories', function (Blueprint $table) {
            $table->enum('amenities_toggle', ['yes', 'no'])->default('no')->after('furnishing_status_toggle');
        });
    }

    public function down()
    {
        Schema::table('sub_sub_categories', function (Blueprint $table) {
            $table->dropColumn('amenities_toggle');
        });
    }
}
