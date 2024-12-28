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
        Schema::create('nilai_raport', function (Blueprint $table) {
            $table->uuid();
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_semester')->constrained('semester')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_mulai_ujian')->constrained('ujian')->onDelete('cascade');
            $table->integer('kkm');
            $table->float('nilai_akhir'); //jumlah dari nilai uas 60%, tugas 25%, uh 25% 
            $table->foreignId('id_kkm')->constrained('kkm')->onDelete('cascade'); //predikat berdasarkan range nilai
            $table->float('rata_rata_permapel');
            $table->foreignId('id_catatan_walikelas')->constrained('catatan_walikelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_raport');
    }
};
