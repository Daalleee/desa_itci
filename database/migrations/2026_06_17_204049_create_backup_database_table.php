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
        Schema::create('backup_database', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file', 255);
            $table->bigInteger('ukuran_file');
            $table->string('lokasi_file', 255);
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_database');
    }
};
