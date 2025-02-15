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
        Schema::create('carts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('match_id')->nullable()->index('fk_match_carts');
            $table->integer('joueur_id')->nullable()->index('fk_joueur_carts');
            $table->char('type', 1);
            $table->integer('minute');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
