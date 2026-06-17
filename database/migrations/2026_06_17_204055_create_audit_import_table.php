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
        Schema::create('audit_import', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_import_id')->constrained('riwayat_import')->cascadeOnDelete();
            $table->string('aksi', 100);
            $table->foreignId('pengguna_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_import');
    }
};
