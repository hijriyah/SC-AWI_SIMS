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
        Schema::create('kehadiran_siswa_ujian', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_rencana_ujian')->constrained('rencana_ujian')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->date('tanggal_kehadiran_ujian');
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->string('nama_siswa')->nullable();
            $table->string('kehadiran_ujian')->nullable();
            $table->integer('tahun');
            $table->string('e_extra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran_siswa_ujian');
    }
};
