<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPopularToWebDirectorySubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('web_directory_sub_categories', function (Blueprint $table) {
            $table->boolean('is_popular')->default(0)->after('sub_category_slug');
        });
    }

    public function down(): void
    {
        Schema::table('web_directory_sub_categories', function (Blueprint $table) {
            $table->dropColumn('is_popular');
        });
    }
}
