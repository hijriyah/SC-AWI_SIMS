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
        Schema::create('jadwal_ujian', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_rencana_ujian')->constrained('rencana_ujian')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->date('tanggal_ujian');
            $table->string('ujian_dari');
            $table->string('ujian_untuk');
            $table->string('ruangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujian');
    }
};
