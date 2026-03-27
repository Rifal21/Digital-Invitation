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
        Schema::create('transactions', function (Blueprint $blueprint) {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $blueprint->foreignUuid('package_id')->constrained()->onDelete('cascade');
            $blueprint->integer('subtotal');
            $blueprint->integer('admin_fee')->default(0);
            $blueprint->integer('total_amount');
            $blueprint->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $blueprint->string('payment_proof')->nullable();
            $blueprint->timestamp('confirmed_at')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
