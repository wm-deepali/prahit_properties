<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Free, Basic, Standard, Premium
            $table->decimal('price', 10, 2)->default(0);
            
            $table->boolean('business_listing')->default(false);
            $table->boolean('profile_page_with_contact')->default(false); // ✅ added
            $table->boolean('business_logo_banner')->default(false); // ✅ added

            $table->integer('service_limit')->nullable(); // total services user can list
            $table->integer('duration')->nullable(); // e.g. 1, 3, 6, 12
            $table->enum('duration_unit', ['days', 'months', 'years'])->nullable();

            $table->integer('image_upload_limit')->nullable(); // e.g. 4, 10, etc.
            $table->boolean('video_upload')->default(false);
            $table->string('appear_in_search')->nullable(); // e.g., No, Medium, High, Top Priority
            $table->boolean('verified_badge')->default(false);
            $table->boolean('premium_badge')->default(false);

            $table->string('lead_enquiries')->nullable(); // Limited, Moderate, High, Priority
            $table->string('response_rate')->nullable(); // Normal, Standard, 2x, 4x
            $table->boolean('featured_in_top')->default(false);
            $table->string('customer_support')->nullable(); // Email, Dedicated, etc.
            $table->boolean('lead_alerts')->default(false);

            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
