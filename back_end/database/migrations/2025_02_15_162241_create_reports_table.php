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
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('reporter_id')->nullable()->index('fk_reporter_report');
            $table->integer('reported_id')->nullable()->index('fk_reported_report');
            $table->char('etat', 2)->default('US');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
