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
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign(['reported_id'], 'fk_reported_report')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['reporter_id'], 'fk_reporter_report')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('fk_reported_report');
            $table->dropForeign('fk_reporter_report');
        });
    }
};
