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
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('section'); // tugas guru, khususnya walikelas
            $table->string('kategori');
            $table->integer('kapasitas')->nullable(); // kapasitas kelas yang dipegang
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->longtext('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section');
    }
};
