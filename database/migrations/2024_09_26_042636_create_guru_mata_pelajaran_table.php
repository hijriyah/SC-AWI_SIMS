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
        Schema::create('guru_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->string('kode_guru_mata_pelajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_mata_pelajaran');
    }
};
