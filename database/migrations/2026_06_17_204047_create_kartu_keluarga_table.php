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
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kk', 20)->unique();
            $table->foreignId('wilayah_id')->constrained('wilayah');
            $table->text('alamat');
            $table->string('kode_pos', 10)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->foreignId('kepala_keluarga_id')->nullable();
            $table->string('status', 20)->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_keluarga');
    }
};
