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
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('theme')->default('modern');
            $table->string('theme_color')->default('#4D243D');
            
            // Event Details
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->text('message')->nullable();
            
            // Groom Assets
            $table->string('groom_name');
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();
            
            // Bride Assets
            $table->string('bride_name');
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();

            // Images
            $table->string('background_image')->nullable();
            $table->string('hero_image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
