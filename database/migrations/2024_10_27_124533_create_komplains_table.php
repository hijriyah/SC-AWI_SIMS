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
        Schema::create('komplains', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('judul');
            $table->foreignId('id_staff')->nullable()->constrained('staff')->onDelete('cascade');
            $table->foreignId('id_siswa')->nullable()->constrained('siswas')->onDelete('cascade');
            $table->foreignId('id_orangtua')->nullable()->constrained('orangtuas')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->string('deskripsi')->nullable();
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplains');
    }
};
