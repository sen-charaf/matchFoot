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
        Schema::create('tournoies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom', 30);
            $table->integer('nbr_equipes');
            $table->string('logo_path', 200)->nullable();
            $table->integer('nbr_round')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournoies');
    }
};
