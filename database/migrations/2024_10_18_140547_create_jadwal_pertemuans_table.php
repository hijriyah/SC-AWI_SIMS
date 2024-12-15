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
        Schema::create('jadwal_pertemuans', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->date('start');
            $table->date('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pertemuans');
    }
};
