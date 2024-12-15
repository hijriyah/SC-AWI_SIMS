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
        Schema::create('tahfidz', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade'); // mengambil nama kelas
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade'); // mengambil nama siswa
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade'); // mengambil nama guru dari jabatan pembimbing alquran
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->string('semester'); // mengambil nama semester dari tabel tahun ajaran

            $table->string('surah');
            $table->string('hasil_perkembangan'); //nilai
            $table->foreignId('id_kriteria_penilaian_alquran')->constrained('kriteria_penilaian_alquran')->onDelete('cascade');
            $table->longtext('kompetensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahfidz');
    }
};
