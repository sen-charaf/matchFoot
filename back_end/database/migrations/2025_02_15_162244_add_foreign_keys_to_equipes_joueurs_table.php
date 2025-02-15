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
        Schema::table('equipes_joueurs', function (Blueprint $table) {
            $table->foreign(['equipe_id'], 'fk_equipe_equipe_joueurs')->references(['id'])->on('equipes')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['joueur_id'], 'fk_joueur_equipe_joueurs')->references(['id'])->on('joueurs')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipes_joueurs', function (Blueprint $table) {
            $table->dropForeign('fk_equipe_equipe_joueurs');
            $table->dropForeign('fk_joueur_equipe_joueurs');
        });
    }
};
