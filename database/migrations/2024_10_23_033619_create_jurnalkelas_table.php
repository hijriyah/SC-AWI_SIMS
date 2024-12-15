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
        Schema::create('jurnalkelas', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('jam');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->date('tanggal');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            // $table->foreignId('id_gurus')->constrained('guru')->onDelete('cascade');
            $table->longtext('materi_ajar');
            $table->string('siswa_hadir');
            $table->string('siswa_tidak_hadir');
            $table->enum('status', ['hadir', 'tidak hadir']);
            $table->string('class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnalkelas');
    }
};
