<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('navbar_menu_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('navbar_settings_id')->constrained('navbar_settings')->onDelete('cascade');
        $table->string('title');
        $table->string('link')->nullable();
        $table->string('type')->default('custom'); // 'custom', 'page', dll
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
        Schema::dropIfExists('navbar_menu_items');
    }
};
