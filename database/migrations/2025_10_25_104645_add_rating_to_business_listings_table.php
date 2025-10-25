<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listings', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->default(0.00)->after('total_enquiries')->comment('Business rating out of 5');
            $table->unsignedInteger('rating_count')->default(0)->after('rating')->comment('Total number of ratings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_listings', function (Blueprint $table) {
            $table->dropColumn(['rating', 'rating_count']);
        });
    }
};
