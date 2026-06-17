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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_warga', 20)->unique();
            $table->foreignId('kartu_keluarga_id')->constrained('kartu_keluarga')->cascadeOnDelete();
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 1);
            $table->foreignId('agama_id')->constrained('agama');
            $table->foreignId('pendidikan_id')->constrained('pendidikan');
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan');
            $table->string('status_perkawinan', 20);
            $table->string('golongan_darah', 5)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('hubungan_keluarga', 20);
            $table->string('status_penduduk', 20)->default('aktif');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
