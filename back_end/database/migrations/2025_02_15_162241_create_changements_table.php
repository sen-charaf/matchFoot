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
        Schema::create('changements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('match_id')->nullable()->index('fk_match_changements');
            $table->integer('joueur_id')->nullable()->index('fk_joueur_changements');
            $table->integer('remplacant_id')->nullable()->index('fk_remplacant_changements');
            $table->integer('minute');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changements');
    }
};
