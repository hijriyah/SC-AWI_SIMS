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
        Schema::create('soal_pilihan', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_bank_soal')->constrained('bank_soal')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_pilihan');
    }
};
