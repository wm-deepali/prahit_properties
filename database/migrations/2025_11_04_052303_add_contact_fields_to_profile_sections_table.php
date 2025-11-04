<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profile_sections', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('user_id');
            $table->string('address')->nullable()->after('description');
            $table->string('phone')->nullable()->after('address');
            $table->string('email')->nullable()->after('phone');
            $table->json('working_hours')->nullable()->after('email');

        });
    }

    public function down(): void
    {
        Schema::table('profile_sections', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone', 'email', 'working_hours', 'logo']);
        });
    }
};
