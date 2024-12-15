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
        Schema::create('status_hasil_ujian', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_ujian')->constrained('ujian')->onDelete('cascade');
            $table->integer('durasi')->nullable();
            $table->integer('skor')->nullable();
            $table->integer('jumlah_soal')->nullable();
            $table->integer('jumlah_terjawab')->nullable();
            $table->integer('jawaban_salah')->nullable();
            $table->time('waktu')->nullable();
            
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->integer('total_jawaban_benar')->nullable();
            $table->integer('persentase_jawaban_benar')->nullable();
            $table->enum('status', ['lulus', 'belum_lulus'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_hasil_ujian');
    }
};
