<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
            $table->id();
            $table->enum('membership_type', ['Free', 'Paid'])->default('Free');
            $table->enum('verified_status', ['Verified', 'Unverified'])->default('Unverified');
            $table->foreignId('category_id');
            $table->string('business_name');
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('website')->nullable();
            $table->year('established_year')->nullable();
            $table->text('introduction')->nullable();
            $table->text('detail')->nullable();
            $table->text('full_address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->unsignedInteger('total_views')->default(0);
            $table->unsignedInteger('total_enquiries')->default(0);
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_listings');
    }
};
