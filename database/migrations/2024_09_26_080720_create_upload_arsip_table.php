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
        Schema::create('upload_arsip', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_kategori_arsip')->constrained('kategori_arsip')->onDelete('cascade');
            $table->string('judul');
            $table->string('file');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_arsip');
    }
};
