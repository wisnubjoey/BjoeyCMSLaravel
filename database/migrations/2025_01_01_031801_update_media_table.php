<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('uploadthing_url')->nullable(); // Ganti nama dari 'url' ke 'uploadthing_url'
            $table->string('type')->default('image');
            $table->string('filename')->nullable();
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['uploadthing_url', 'type', 'filename']);
        });
    }
};  