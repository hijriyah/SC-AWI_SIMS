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
        Schema::create('bank_soal', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->longtext('soal');
            $table->longtext('penjelasan')->nullable();
            $table->enum('level_soal', ['easy', 'medium', 'hard']);
            $table->enum('tipe_soal', ['pilihan_ganda', 'akm', 'esai']);
            $table->foreignId('id_grup_soal')->constrained('grup_soal')->onDelete('cascade');
            $table->integer('jumlah_soal')->nullable();
            $table->integer('jumlah_pilihan')->nullable();
            $table->string('jawaban_benar')->nullable();
            $table->foreignId('id_orangtua')->constrained('orangtuas')->onDelete('cascade');
            $table->integer('waktu')->nullable();
            $table->integer('mark')->nullable();
            $table->longtext('petunjuk')->nullable();
            $table->string('file');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_soal');
    }
};
