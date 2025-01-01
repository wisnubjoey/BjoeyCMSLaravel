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
        Schema::create('navigation', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable(); // untuk menyimpan path logo
            $table->string('site_name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('navigation_id')->constrained('navigation')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('type')->default('page'); // page, link, dll
            $table->text('content')->nullable(); // untuk konten halaman
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
        Schema::dropIfExists('navigation');
        Schema::dropIfExists('navigation_items');
    }
};
