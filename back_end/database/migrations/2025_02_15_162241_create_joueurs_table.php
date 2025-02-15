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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom', 30);
            $table->string('prenom', 30);
            $table->date('date_naissance');
            $table->decimal('poid', 4)->nullable();
            $table->decimal('taill', 5)->nullable();
            $table->char('pied', 1)->nullable();
            $table->string('photo_path', 200)->nullable();
            $table->integer('nationalite_id')->nullable()->index('fk_pays_joueur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
