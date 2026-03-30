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
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('invitation_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('phone')->nullable();
            $table->string('group')->nullable();
            $table->string('rsvp_status')->default('invited'); // invited, attending, declined
            $table->boolean('is_attended')->default(false);
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
