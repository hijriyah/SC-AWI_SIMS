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
        Schema::create('ujian_jawaban_soal_pilihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bank_soal')->constrained('bank_soal')->onDelete('cascade');
            $table->foreignId('id_soal_pilihan')->constrained('soal_pilihan')->onDelete('cascade');
            $table->integer('tipe');
            $table->longtext('teks');
            $table->time('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_jawaban_soal_pilihan');
    }
};
