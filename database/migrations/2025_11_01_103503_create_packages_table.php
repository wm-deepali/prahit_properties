<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            // Common fields
            $table->enum('package_type', ['property', 'service']);
            $table->string('name')->unique();
            $table->string('price'); // can include ₹ symbol or text (e.g. "1,999/- for 3 months")
            $table->string('validity')->nullable(); // e.g., "30 days", "3 months"
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);

            // ===== PROPERTY PACKAGE FIELDS =====
            $table->integer('number_of_listing')->nullable();
            $table->integer('photos_per_listing')->nullable();
            $table->string('video_upload')->nullable(); // "Yes" / "Not Allowed"
            $table->string('response_rate')->nullable(); // "Normal", "Standard", etc.
            $table->string('property_visibility')->nullable(); // "Normal", "High", etc.
            $table->string('verified_tag')->nullable(); // "Yes" / "No"
            $table->string('premium_seller')->nullable(); // "Yes" / "No"
            $table->string('profile_page')->nullable(); // "Yes" / "No"
            $table->string('profile_visibility')->nullable(); // "Normal", "Featured", etc.
            $table->string('profile_in_search_result')->nullable(); // "Yes" / "No"
            $table->string('priority_in_search')->nullable(); // "No", "Medium", "High", "Top Priority"
            $table->string('customer_support')->nullable(); // e.g. "Email / Phone / Chat"
            $table->string('lead_alerts')->nullable(); // "Yes" / "No"

            // ===== SERVICE PROVIDER PACKAGE FIELDS =====
            $table->string('business_listing')->nullable(); // "Yes" / "No"
            $table->integer('total_services')->nullable();
            $table->string('profile_page_with_contact')->nullable(); // "Yes" / "No"
            $table->string('business_logo_banner')->nullable(); // "Yes" / "No"
            $table->string('appear_in_local_search')->nullable(); // "No", "Medium", "High", "Top Priority"
            $table->string('verified_badge')->nullable(); // "Yes" / "No"
            $table->string('premium_badge')->nullable(); // "Yes" / "No"
            $table->integer('image_upload_limit')->nullable();
            $table->string('video_upload_service')->nullable(); // "Yes" / "Not Allowed"
            $table->string('lead_enquiries')->nullable(); // "Limited", "Moderate", etc.
            $table->string('response_rate_service')->nullable(); // "Normal", "Upto 2 times more", etc.
            $table->string('featured_in_top_provider')->nullable(); // "Yes" / "No"
            $table->string('customer_support_service')->nullable(); // "Email", "Dedicated", etc.
            // NOTE: lead_alerts is shared for both, no duplicate needed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
