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
        Schema::create('riwayat_import', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_import', 50);
            $table->string('nama_file', 255);
            $table->string('lokasi_file', 255);
            $table->integer('total_baris');
            $table->integer('berhasil_import');
            $table->integer('gagal_import');
            $table->string('status', 50);
            $table->text('catatan')->nullable();
            $table->foreignId('diimpor_oleh')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_import');
    }
};
