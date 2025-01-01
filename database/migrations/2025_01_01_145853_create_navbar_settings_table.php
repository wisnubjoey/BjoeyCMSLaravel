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
        Schema::create('navbar_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_generated')->default(false);
            $table->string('logo_url')->nullable();
            $table->string('site_name')->nullable();
            $table->json('settings')->nullable(); // Untuk konfigurasi tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navbar_settings');
    }
};
