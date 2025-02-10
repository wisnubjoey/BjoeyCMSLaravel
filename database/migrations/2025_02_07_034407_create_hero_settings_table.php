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
        Schema::create('hero_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_generated')->default(false);
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('background_type')->default('color'); // color atau image
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('alignment')->default('center'); // left, center, right
            $table->json('settings')->nullable(); // untuk styling tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_settings');
    }
};
