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
        Schema::table('lignups', function (Blueprint $table) {
            $table->foreign(['equipe_id'], 'fk_equipe_lignup')->references(['id'])->on('equipes')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['joeur_id'], 'fk_joeur_lignup')->references(['id'])->on('joueurs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['match_id'], 'fk_match_lignup')->references(['id'])->on('matchs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['position_id'], 'fk_position_lignup')->references(['id'])->on('positions')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lignups', function (Blueprint $table) {
            $table->dropForeign('fk_equipe_lignup');
            $table->dropForeign('fk_joeur_lignup');
            $table->dropForeign('fk_match_lignup');
            $table->dropForeign('fk_position_lignup');
        });
    }
};
