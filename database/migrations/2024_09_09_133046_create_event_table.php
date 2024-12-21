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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            // $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->date('tanggal_mulai');

            $table->date('tanggal_selesai');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('judul');
            $table->longtext('deskripsi');
            $table->string('file')->nullable();
            $table->enum('status', ['akan dilaksanakan', 'sedang dilaksanakan', 'berakhir']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
