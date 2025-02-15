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
        Schema::table('stads', function (Blueprint $table) {
            $table->foreign(['ville_id'], 'fk_ville_stad')->references(['id'])->on('villes')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stads', function (Blueprint $table) {
            $table->dropForeign('fk_ville_stad');
        });
    }
};
