<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToBusinessListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('business_listings', function (Blueprint $table) {
        $table->string('registration_number')->nullable()->after('pin_code');
        $table->string('deals_in')->nullable()->after('registration_number');
        $table->integer('satisfied_clients')->nullable()->after('deals_in');
    });
}

public function down()
{
    Schema::table('business_listings', function (Blueprint $table) {
        $table->dropColumn(['registration_number', 'deals_in', 'satisfied_clients']);
    });
}

}
