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
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->longText('sejarah');
            $table->longText('visi');
            $table->longText('misi');
            $table->longText('sambutan')->nullable();
            $table->string('luas_wilayah', 100)->nullable();
            $table->string('batas_utara', 255)->nullable();
            $table->string('batas_selatan', 255)->nullable();
            $table->string('batas_timur', 255)->nullable();
            $table->string('batas_barat', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
