<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileNumberToFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function ($table) {
            $table->string('mobile_number', 15)->after('property_id');
            $table->string('email')->nullable()->after('mobile_number');
        });
    }

    public function down()
    {
        Schema::table('feedback', function ($table) {
            $table->dropColumn('mobile_number');
            $table->dropColumn('email');

        });
    }

}
