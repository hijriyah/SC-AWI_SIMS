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
        Schema::create('rencana_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->longtext('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->longtext('lokasi_kegiatan');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_kegiatan');
    }
};
