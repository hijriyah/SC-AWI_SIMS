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
        Schema::create('gkmedia_galeri', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->integer('tipe_media_galeri');
            $table->string('tipe_file')->nullable();
            $table->string('nama_file')->nullable();
            $table->longtext('judul_file');
            $table->string('ukuran_file')->nullable();
            $table->string('width_height_file')->nullable();
            $table->date('tanggal_upload')->nullable();
            $table->longtext('caption')->nullable();
            $table->longtext('deskripsi')->nullable();
            $table->string('panjang_file');
            $table->string('artist_file')->nullable();
            $table->string('album_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gkmedia_galeri');
    }
};
