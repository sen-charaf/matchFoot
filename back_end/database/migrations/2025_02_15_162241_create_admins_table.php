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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('username', 30)->unique('username');
            $table->string('email', 60);
            $table->string('nom', 30);
            $table->string('prenom', 30);
            $table->string('role', 10);
            $table->integer('num_telephone')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('profile_path', 200)->nullable();
            $table->string('password', 300);
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
