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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama_kelas');
            $table->enum('kelas_angka', ['7', '8', '9']);
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->integer('maksimal_siswa')->nullable();
            $table->longtext('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
