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
        Schema::create('data_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_pelanggaran')->constrained('pelanggaran')->onDelete('cascade');
            $table->integer('subtotal_poin');
            $table->integer('total_poin');
            $table->foreignId('id_sanksi_pelanggaran')->constrained('sanksi_pelanggaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggaran');
    }
};
