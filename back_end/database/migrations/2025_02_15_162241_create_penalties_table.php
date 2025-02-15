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
        Schema::create('penalties', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable()->index('fk_user_penalty');
            $table->integer('admin_id')->nullable()->index('fk_admin_penalty');
            $table->char('penalty', 1)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
