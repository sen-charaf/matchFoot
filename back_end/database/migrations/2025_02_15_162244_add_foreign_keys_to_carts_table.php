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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign(['joueur_id'], 'fk_joueur_carts')->references(['id'])->on('joueurs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['match_id'], 'fk_match_carts')->references(['id'])->on('matchs')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign('fk_joueur_carts');
            $table->dropForeign('fk_match_carts');
        });
    }
};
