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
        Schema::create('sanksi_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->enum('bentuk_sanksi', ['tindakan_langsung', 'teguran', 'surat_peringatan', 'skorsing']);
            $table->integer('maksimal_poin');
            $table->foreignId('id_pelanggaran')->constrained('pelanggaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanksi_pelanggaran');
    }
};
