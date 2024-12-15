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
        Schema::create('ujian', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama');
            $table->longtext('deskripsi')->nullable();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            //$table->foreignId('id_siswa_grup')->constrained('siswa_grup')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_instruksi_ujian')->constrained('instruksi_ujian')->onDelete('cascade');
            //$table->enum('status_ujian', ['aktif', 'tidak_aktif']);
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->integer('no_tipe_ujian')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('random')->nullable();
            $table->integer('public')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->nullable();
            //$table->foreignId('id_mark')->constrained('mark')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->integer('poin_benar')->nullable();
            $table->integer('total_poin')->nullable();
            $table->integer('persentase')->nullable();
            
             $table->foreignId('id_bank_soal')->constrained('bank_soal')->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->enum('publish', ['ya', 'tidak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian');
    }
};
