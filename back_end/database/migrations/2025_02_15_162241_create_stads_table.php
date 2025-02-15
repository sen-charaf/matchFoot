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
        Schema::create('stads', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom', 50);
            $table->integer('capacity');
            $table->integer('ville_id')->nullable()->index('fk_ville_stad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stads');
    }
};
