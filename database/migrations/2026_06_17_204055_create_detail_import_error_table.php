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
        Schema::create('detail_import_error', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_import_id')->constrained('riwayat_import')->cascadeOnDelete();
            $table->integer('nomor_baris');
            $table->text('pesan_error');
            $table->json('data_baris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_import_error');
    }
};
