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
        Schema::table('contact_lost_reports', function (Blueprint $table) {
            $table->foreignId('reported_lost_id')->constrained('report_losts')->onDelete('cascade')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           Schema::table('contact_lost_reports', function (Blueprint $table) {
            $table->dropColumn('reported_lost_id');
        });
    }
};
