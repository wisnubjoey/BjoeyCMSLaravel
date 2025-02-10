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
        Schema::create('features_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_generated')->default(false);
            $table->string('section_title')->nullable();
            $table->text('section_description')->nullable();
            $table->string('layout')->default('grid'); // grid, columns, cards
            $table->json('settings')->nullable();
            $table->timestamps();
        });

        Schema::create('feature_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('features_settings_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features_settings');
        Schema::dropIfExists('feature_items');
    }
};
    