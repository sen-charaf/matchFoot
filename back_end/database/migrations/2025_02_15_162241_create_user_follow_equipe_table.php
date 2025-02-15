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
        Schema::create('user_follow_equipe', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable()->index('fk_user_follow');
            $table->integer('equipe_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_follow_equipe');
    }
};
