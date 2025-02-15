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
        Schema::table('equipes', function (Blueprint $table) {
            $table->foreign(['stad_id'], 'fk_stad_equipes')->references(['id'])->on('stads')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['entraineur_id'], 'fk_staff_equipes')->references(['id'])->on('staffs')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipes', function (Blueprint $table) {
            $table->dropForeign('fk_stad_equipes');
            $table->dropForeign('fk_staff_equipes');
        });
    }
};
