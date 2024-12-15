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
        Schema::create('event_counter', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('id_event')->constrained('event')->onDelete('cascade');
            $table->string('username');
            $table->string('tipe');
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_counter');
    }
};
