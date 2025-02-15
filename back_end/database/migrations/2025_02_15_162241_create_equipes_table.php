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
        Schema::create('equipes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom', 50);
            $table->string('nickname', 10);
            $table->string('logo_path', 200)->nullable();
            $table->integer('entraineur_id')->nullable()->index('fk_staff_equipes');
            $table->integer('stad_id')->nullable()->index('fk_stad_equipes');
            $table->integer('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
