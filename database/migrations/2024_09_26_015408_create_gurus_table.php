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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->date('tanggal_bergabung');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'kristen', 'katholik', 'hindu', 'buddha', 'konghucu']);
            $table->string('email');
            $table->string('no_telp');
            $table->longtext('alamat');
            $table->longtext('photo')->nullable();
            //$table->foreignId('id_jabatan_guru')->constrained('jabatan_guru')->onDelete('cascade');
            $table->string('username');
            $table->string('password');
            $table->enum('aktif', ['ya', 'tidak']);
            $table->string('warna')->nullable();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
