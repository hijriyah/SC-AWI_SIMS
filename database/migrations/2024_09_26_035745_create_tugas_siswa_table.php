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
        Schema::create('tugas_siswa', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('judul'); // judul tugas
            $table->longtext('deskripsi');
            $table->date('deadline');
            $table->string('file'); // tugas yang berupa file
            $table->string('jawaban')->nullable();
            $table->foreignId('id_siswa')->nullable()->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_siswa');
    }
};
