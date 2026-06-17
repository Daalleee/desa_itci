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
        Schema::create('notifikasi_sistem', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->text('pesan');
            $table->string('tipe', 20);
            $table->boolean('dibaca')->default(false);
            $table->foreignId('pengguna_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_sistem');
    }
};
