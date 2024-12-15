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
        Schema::create('nilai_sikap', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_semester')->constrained('semester')->onDelete('cascade');
            $table->foreignId('id_kategori_penilaian_sikap')->constrained('kategori_penilaian_sikap')->onDelete('cascade');
            $table->enum('predikat', ['a', 'b', 'c', 'd']);
            $table->longtext('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sikap');
    }
};
