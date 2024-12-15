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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama_barang_masuk')->nullable();
            $table->string('serial');
            $table->longtext('deskripsi')->nullable();
            $table->string('manufaktur')->nullable();
            $table->string('brand')->nullable();
            $table->string('nomor_barang')->nullable();
            $table->date('tanggal_masuk');
            $table->integer('jumlah_masuk');
            $table->enum('status', ['snp', 'non_snp'])->nullable();
            $table->enum('kondisi_barang', ['baik', 'rusak'])->nullable();
            $table->longtext('file')->nullable();
            $table->foreignId('id_kategori_barang')->constrained('kategori_barang')->onDelete('cascade');
            $table->foreignId('id_lokasi_barang')->constrained('lokasi_barang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
