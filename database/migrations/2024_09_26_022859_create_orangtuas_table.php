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
        Schema::create('orangtuas', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('email');
            $table->string('no_telp');
            $table->longtext('alamat');
            $table->longtext('photo')->nullable();
            $table->enum('aktif', ['ya', 'tidak']);
            $table->string('username');
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtuas');
    }
};
