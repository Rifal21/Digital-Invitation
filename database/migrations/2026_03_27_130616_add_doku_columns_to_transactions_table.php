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
            $table->string('payment_url')->nullable()->after('payment_proof');
            $table->json('response_payload')->nullable()->after('payment_url');
            $table->string('payment_method')->nullable()->after('response_payload');
            $table->timestamp('paid_at')->nullable()->after('confirmed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_url', 'response_payload', 'payment_method', 'paid_at']);
        });
    }
};
