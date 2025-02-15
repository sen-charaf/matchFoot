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
        Schema::table('penalties', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'fk_admin_penalty')->references(['id'])->on('admins')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['user_id'], 'fk_user_penalty')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penalties', function (Blueprint $table) {
            $table->dropForeign('fk_admin_penalty');
            $table->dropForeign('fk_user_penalty');
        });
    }
};
