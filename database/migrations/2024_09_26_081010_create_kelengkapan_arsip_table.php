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
        Schema::create('kelengkapan_arsip', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_upload_arsip')->constrained('upload_arsip')->onDelete('cascade');
            $table->enum('status_kelengkapan', ['lengkap', 'belum lengkap']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelengkapan_arsip');
    }
};
