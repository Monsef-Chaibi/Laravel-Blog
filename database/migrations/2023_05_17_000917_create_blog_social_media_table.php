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
        Schema::create('blog_social_media', function (Blueprint $table) {
            $table->id();
            $table->string('url_facebook')->nullable();
            $table->string('url_instagram')->nullable();
            $table->string('url_youtube')->nullable();
            $table->string('url_twitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_social_media');
    }
};
