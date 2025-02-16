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
        Schema::table('user_follow_equipe', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_user_follow')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_follow_equipe', function (Blueprint $table) {
            $table->dropForeign('fk_user_follow');
        });
    }
};
