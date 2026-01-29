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
        Schema::table('parking_spots', function (Blueprint $table) {
            $table->decimal('driving_distance_meters', 6, 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_spots', function (Blueprint $table) {
            $table->dropColumn('driving_distance_meters');
        });
    }
};
