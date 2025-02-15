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
        Schema::create('match_arbitres', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('match_id')->nullable()->index('fk_match_arbitres_match');
            $table->integer('arbitre_id')->nullable()->index('fk_arbitre_arbitres_match');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_arbitres');
    }
};
