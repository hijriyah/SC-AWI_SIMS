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
        Schema::create('sosial_links', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('google');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosial_links');
    }
};
