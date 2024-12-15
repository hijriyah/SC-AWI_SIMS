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
        Schema::create('kehadiran_guru_mengajar', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('gurus')->onDelete('cascade');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->date('tanggal_kehadiran');
            $table->time('jam ke');
            $table->foreignId('id_mata_pelajaran')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('id_materi_mata_pelajaran')->constrained('materi_mata_pelajaran')->onDelete('cascade');
            
            /*$table->string('a1')->nullable();
            $table->string('a2')->nullable();
            $table->string('a3')->nullable();
            $table->string('a4')->nullable();
            $table->string('a5')->nullable();
            $table->string('a6')->nullable();
            $table->string('a7')->nullable();
            $table->string('a8')->nullable();
            $table->string('a9')->nullable();
            $table->string('a10')->nullable();
            $table->string('a11')->nullable();
            $table->string('a12')->nullable();
            $table->string('a13')->nullable();
            $table->string('a14')->nullable();
            $table->string('a15')->nullable();
            $table->string('a16')->nullable();
            $table->string('a17')->nullable();
            $table->string('a18')->nullable();
            $table->string('a19')->nullable();
            $table->string('a20')->nullable();
            $table->string('a21')->nullable();
            $table->string('a22')->nullable();
            $table->string('a23')->nullable();
            $table->string('a24')->nullable();
            $table->string('a25')->nullable();
            $table->string('a26')->nullable();
            $table->string('a27')->nullable();
            $table->string('a28')->nullable();
            $table->string('a29')->nullable();
            $table->string('a30')->nullable();
            $table->string('a31')->nullable();*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran_guru_mengajar');
    }
};
