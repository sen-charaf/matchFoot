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
        Schema::table('buts', function (Blueprint $table) {
            $table->foreign(['assisteur_id'], 'fk_assisteur_buts')->references(['id'])->on('joueurs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['buteur_id'], 'fk_buteur_buts')->references(['id'])->on('joueurs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['match_id'], 'fk_match_buts')->references(['id'])->on('matchs')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buts', function (Blueprint $table) {
            $table->dropForeign('fk_assisteur_buts');
            $table->dropForeign('fk_buteur_buts');
            $table->dropForeign('fk_match_buts');
        });
    }
};
