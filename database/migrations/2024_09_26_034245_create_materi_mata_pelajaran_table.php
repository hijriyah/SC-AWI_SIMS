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
        Schema::create('materi_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->string('materi');
            $table->longtext('deskripsi');
            $table->string('author'); // pemilik materi, bisa jadi guru
            $table->longtext('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_mata_pelajaran');
    }
};
