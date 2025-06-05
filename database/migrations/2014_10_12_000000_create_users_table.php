<?php

use Carbon\Carbon;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->text('bio')->nullable();
            $table->string('picture')->default('uploads/profile/default_profile_picture.png');
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->timestamp('join_date')->default(Carbon::now());
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('blocked')->default(0);
            $table->integer('direct_publish')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
