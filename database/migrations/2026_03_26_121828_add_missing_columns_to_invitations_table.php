<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            if (!Schema::hasColumn('invitations', 'event_location')) {
                $table->string('event_location')->nullable()->after('event_date');
            }
            if (!Schema::hasColumn('invitations', 'theme')) {
                $table->string('theme')->nullable()->after('event_location');
            }
            if (!Schema::hasColumn('invitations', 'theme_color')) {
                $table->string('theme_color')->nullable()->after('theme');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['event_location', 'theme', 'theme_color']);
        });
    }
};
