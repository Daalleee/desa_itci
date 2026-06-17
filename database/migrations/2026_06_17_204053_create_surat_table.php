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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 100);
            $table->foreignId('penduduk_id')->constrained('penduduk');
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat');
            $table->text('keperluan');
            $table->json('data_snapshot');
            $table->string('file_pdf', 255);
            $table->timestamp('dicetak_pada')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
