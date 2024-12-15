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
        Schema::create('jurnalkesiswaan', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->longtext('program');
            $table->time('waktu_realisasi')->nullable();
            $table->longtext('evaluasi');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnalkesiswaan');
    }
};
