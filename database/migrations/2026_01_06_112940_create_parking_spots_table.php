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
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->string('street_name');
            $table->string('day_from');
            $table->string('day_to');
            $table->time('time_from');
            $table->time('time_to');
            $table->boolean('is_free')->default(true);
            $table->text('description')->nullable();
            $table->string('map_link');
            $table->decimal('distance_meters', 6, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};
