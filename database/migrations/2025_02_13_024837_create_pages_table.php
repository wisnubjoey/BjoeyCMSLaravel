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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        $table->string('slug')->unique();
        $table->text('content')->nullable();
        $table->string('layout')->default('default'); // default, full-width, sidebar
        $table->json('sections')->nullable(); // untuk menyimpan urutan section
        $table->json('meta')->nullable(); // untuk SEO meta
        $table->boolean('is_published')->default(false);
        $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
