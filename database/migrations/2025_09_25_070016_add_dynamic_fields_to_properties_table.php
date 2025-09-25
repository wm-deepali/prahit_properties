<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('price_label_second')->nullable()->after('price_label');
            $table->string('property_status')->nullable()->after('price_label_second');
            $table->string('property_status_second')->nullable()->after('property_status');
            $table->string('registration_status')->nullable()->after('property_status_second');
            $table->string('registration_status_second')->nullable()->after('registration_status');
            $table->string('furnishing_status')->nullable()->after('registration_status_second');
            $table->string('furnishing_status_second')->nullable()->after('furnishing_status');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'price_label_second',
                'property_status',
                'property_status_second',
                'registration_status',
                'registration_status_second',
                'furnishing_status',
                'furnishing_status_second'
            ]);
        });
    }
};
