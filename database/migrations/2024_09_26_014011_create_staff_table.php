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
        Schema::create('staff', function (Blueprint $table) {
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
            $table->string('username');
            $table->string('password');
            $table->longtext('DefaultHash');
            $table->longtext('deskripsi');
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
        Schema::dropIfExists('staff');
    }
};
