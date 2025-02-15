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
        Schema::create('matchs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tournoie_id')->nullable()->index('fk_tournoie_match');
            $table->integer('equipe1_id')->nullable()->index('fk_equipe1_match');
            $table->integer('equipe2_id')->nullable()->index('fk_equipe2_match');
            $table->date('jour_match')->nullable();
            $table->dateTime('played_time')->nullable();
            $table->integer('stad_id')->nullable()->index('fk_stad_match');
            $table->integer('round')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchs');
    }
};
