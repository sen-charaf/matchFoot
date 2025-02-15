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
        Schema::table('matchs', function (Blueprint $table) {
            $table->foreign(['equipe1_id'], 'fk_equipe1_match')->references(['id'])->on('equipes')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['equipe2_id'], 'fk_equipe2_match')->references(['id'])->on('equipes')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['stad_id'], 'fk_stad_match')->references(['id'])->on('stads')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['tournoie_id'], 'fk_tournoie_match')->references(['id'])->on('tournoies')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dropForeign('fk_equipe1_match');
            $table->dropForeign('fk_equipe2_match');
            $table->dropForeign('fk_stad_match');
            $table->dropForeign('fk_tournoie_match');
        });
    }
};
