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
        Schema::create('izin_kenaikan_kelas', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->enum('status', ['aktif', 'tidak_aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_kenaikan_kelas');
    }
};
