<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_property_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_listing_id')
                  ->constrained('business_listings')
                  ->onDelete('cascade');
            $table->foreignId('category_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_property_categories');
    }
};

