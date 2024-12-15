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
        Schema::create('buku_bermasalah', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_buku')->constrained('buku')->onDelete('cascade');
            $table->string('nomor_serial');
            $table->date('tanggal_keluar');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_pengembalian');
            $table->longtext('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_bermasalah');
    }
};
