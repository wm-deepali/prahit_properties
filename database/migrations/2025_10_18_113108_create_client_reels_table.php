<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientReelsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_reels', function (Blueprint $table) {
            $table->id();
            
            $table->string('author_name');
            $table->string('author_image')->nullable();
            $table->string('designation')->nullable();
            $table->enum('reel_type', ['youtube', 'facebook', 'upload'])->default('youtube');
            $table->string('youtube_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('video_file')->nullable(); // store file path if uploaded

            // Author Info

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_reels');
    }
}
