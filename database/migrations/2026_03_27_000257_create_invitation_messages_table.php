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
        Schema::create('invitation_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('message');
            $table->boolean('is_attending')->default(true);
            $table->integer('guest_count')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_messages');
    }
};
