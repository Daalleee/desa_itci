<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropForeign(['kartu_keluarga_id']);
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->unsignedBigInteger('kartu_keluarga_id')->nullable()->change();
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreign('kartu_keluarga_id')->references('id')->on('kartu_keluarga')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropForeign(['kartu_keluarga_id']);
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->unsignedBigInteger('kartu_keluarga_id')->nullable(false)->change();
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreign('kartu_keluarga_id')->references('id')->on('kartu_keluarga')->cascadeOnDelete();
        });
    }
};
