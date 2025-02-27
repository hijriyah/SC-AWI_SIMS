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
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('tipe_sekolah')->nullable();
            $table->string('tahun_ajaran');
            $table->string('judul');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_ajaran');
    }
};
