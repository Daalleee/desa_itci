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
        Schema::create('konfigurasi_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa', 255);
            $table->text('alamat');
            $table->string('telepon', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('nama_kepala_desa', 255);
            $table->string('nama_sekretaris', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_desa');
    }
};
