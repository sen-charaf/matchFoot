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
        Schema::table('match_arbitres', function (Blueprint $table) {
            $table->foreign(['arbitre_id'], 'fk_arbitre_arbitres_match')->references(['id'])->on('staffs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['match_id'], 'fk_match_arbitres_match')->references(['id'])->on('matchs')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('match_arbitres', function (Blueprint $table) {
            $table->dropForeign('fk_arbitre_arbitres_match');
            $table->dropForeign('fk_match_arbitres_match');
        });
    }
};
