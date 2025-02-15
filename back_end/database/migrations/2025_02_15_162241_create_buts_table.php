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
        Schema::create('buts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('match_id')->nullable()->index('fk_match_buts');
            $table->integer('buteur_id')->nullable()->index('fk_buteur_buts');
            $table->integer('assisteur_id')->nullable()->index('fk_assisteur_buts');
            $table->integer('minute');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buts');
    }
};
