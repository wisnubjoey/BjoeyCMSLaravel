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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
        $table->boolean('is_generated')->default(false);
        $table->string('company_name')->nullable();
        $table->text('description')->nullable();
        $table->string('copyright_text')->nullable();
        $table->json('social_links')->nullable(); // { "facebook": "url", "twitter": "url", etc }
        $table->json('quick_links')->nullable(); // [{"title": "About", "url": "/about"}, etc]
        $table->json('contact_info')->nullable(); // {"email": "", "phone": "", "address": ""}
        $table->json('settings')->nullable(); // untuk styling tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
