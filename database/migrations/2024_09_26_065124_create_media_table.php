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
        Schema::create('mediaSubF1', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama');
            $table->foreignId('id_mediaParent')->constrained('mediaParent')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediaSubF1');
    }
};
