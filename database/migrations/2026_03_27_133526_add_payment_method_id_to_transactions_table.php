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
        Schema::table('transactions', function (Blueprint $table) {
            // Drop it if it somehow exists already (to fix the 'already exists' collision)
            if (Schema::hasColumn('transactions', 'payment_method_id')) {
                $table->dropColumn('payment_method_id');
            }
        });

        Schema::table('transactions', function (Blueprint $table) {
            // Now add it back as the correct UUID type
            $table->uuid('payment_method_id')->nullable()->after('package_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('payment_method_id');
        });
    }
};
