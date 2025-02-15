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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign(['match_id'], 'fk_match_comment')->references(['id'])->on('matchs')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['user_id'], 'fk_user_comment')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('fk_match_comment');
            $table->dropForeign('fk_user_comment');
        });
    }
};
