<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubSubCategoryIdToFormTypesCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_types_cats', function ($table) {
            $table->unsignedBigInteger('sub_sub_category_id')->nullable()->after('sub_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_types_cats', function ($table) {
            $table->dropColumn('sub_sub_category_id');
        });
    }
}
