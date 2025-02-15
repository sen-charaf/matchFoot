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
        Schema::create('equipes_joueurs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('equipe_id')->nullable()->index('fk_equipe_equipe_joueurs');
            $table->integer('joueur_id')->nullable()->index('fk_joueur_equipe_joueurs');
            $table->date('started_at');
            $table->date('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes_joueurs');
    }
};
