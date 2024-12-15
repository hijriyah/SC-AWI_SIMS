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
        Schema::create('identitas_sekolah', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama_sekolah');
            $table->longtext('alamat');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('file'); // logo sekolah
            $table->string('nama_kepala_sekolah');
            $table->string('nip_kepala_sekolah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_sekolah');
    }
};
