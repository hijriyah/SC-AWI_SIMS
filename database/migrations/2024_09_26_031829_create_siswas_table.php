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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
             $table->uuid()->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'kristen', 'katholik', 'hindu', 'buddha', 'konghucu']);
            $table->string('email');
            $table->string('no_telp');
            $table->longtext('alamat');
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('id_section')->constrained('section')->onDelete('cascade');
            $table->enum('golongan_darah', ['ab+', 'ab-', 'a+', 'a-', 'b+', 'b-', 'o+', 'o-']);
            $table->enum('kebangsaan', ['wni', 'wna']);
            $table->string('negara');
            $table->string('nomor_register');
            $table->date('tanggal_masuk');
            $table->foreignId('id_orangtua')->constrained('orangtuas')->onDelete('cascade');
            $table->longtext('photo')->nullable();
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->string('username');
            $table->string('password');
            $table->enum('aktif', ['ya', 'tidak']);
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
