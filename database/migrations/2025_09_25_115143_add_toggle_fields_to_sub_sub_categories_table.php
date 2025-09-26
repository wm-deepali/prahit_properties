<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sub_sub_categories', function (Blueprint $table) {
            $table->enum('price_label_toggle', ['no', 'yes'])->default('no')->after('sub_sub_category_keywords');
            $table->enum('property_status_toggle', ['no', 'yes'])->default('no')->after('price_label_toggle');
            $table->enum('registration_status_toggle', ['no', 'yes'])->default('no')->after('property_status_toggle');
            $table->enum('furnishing_status_toggle', ['no', 'yes'])->default('no')->after('registration_status_toggle');
        });
    }

    public function down()
    {
        Schema::table('sub_sub_categories', function (Blueprint $table) {
            $table->dropColumn([
                'price_label_toggle', 
                'property_status_toggle', 
                'registration_status_toggle', 
                'furnishing_status_toggle'
            ]);
        });
    }
};
