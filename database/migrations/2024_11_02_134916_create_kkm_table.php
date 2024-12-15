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
        Schema::create('kkm', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->integer('range_nilai_kkm');
            $table->enum('predikat', ['a', 'b', 'c', 'd']);
            $table->longtext('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kkm');
    }
};
