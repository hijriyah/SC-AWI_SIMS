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
        Schema::create('jurnalbk', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('bulan', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'agustus', 'september', 'oktober', 'november', 'desember']); 
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->enum('minggu_ke', ['i', 'ii', 'iii', 'iv', 'v']);
            $table->date('tanggal_kegiatan');
            $table->string('sasaran_kegiatan');
            $table->foreignId('id_bimbingan_konseling')->constrained('bimbingan_konseling')->onDelete('cascade');
            $table->longtext('hasil_capai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnalbk');
    }
};
