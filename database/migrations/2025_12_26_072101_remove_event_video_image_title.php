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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['is_event', 'title', 'image', 'video']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_event')->default(false);
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
        });
    }
};
