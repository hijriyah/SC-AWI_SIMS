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
        Schema::create('nilai_umum', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->float('nilai_uas');
            $table->float('nilai_tugas');
            $table->float('nilai_uh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_umum');
    }
};
