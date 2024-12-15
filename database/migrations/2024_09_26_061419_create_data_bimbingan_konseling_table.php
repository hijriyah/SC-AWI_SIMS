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
        Schema::create('data_bimbingan_konseling', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_bimbingan_konseling')->constrained('bimbingan_konseling')->onDelete('cascade');
            $table->longtext('saran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bimbingan_konseling');
    }
};
