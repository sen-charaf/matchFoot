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
        Schema::create('lignups', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('match_id')->nullable()->index('fk_match_lignup');
            $table->integer('equipe_id')->nullable()->index('fk_equipe_lignup');
            $table->integer('joeur_id')->nullable()->index('fk_joeur_lignup');
            $table->integer('position_id')->nullable()->index('fk_position_lignup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignups');
    }
};
