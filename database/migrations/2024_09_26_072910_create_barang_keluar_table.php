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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_barang_masuk')->constrained('barang_masuk')->onDelete('cascade');
            $table->date('jatuh_tempo')->nullable();
            $table->longtext('catatan')->nullable();
            $table->integer('jumlah_keluar')->nullable();
            $table->enum('status', ['snp', 'non_snp'])->nullable();
            $table->enum('kondisi_barang', ['baik', 'rusak'])->nullable();
            $table->foreignId('id_lokasi_barang')->constrained('lokasi_barang')->onDelete('cascade');
            $table->date('tanggal_keluar')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
