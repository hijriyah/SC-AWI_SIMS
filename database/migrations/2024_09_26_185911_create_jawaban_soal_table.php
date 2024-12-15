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
        Schema::create('jawaban_soal', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_bank_soal')->constrained('bank_soal')->onDelete('cascade');
            $table->foreignId('id_soal_pilihan')->constrained('soal_pilihan')->onDelete('cascade');
            $table->string('tipe_soal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_soal');
    }
};
