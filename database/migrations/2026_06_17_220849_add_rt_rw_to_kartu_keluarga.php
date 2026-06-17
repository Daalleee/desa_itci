<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartu_keluarga', function (Blueprint $table) {
            $table->string('rt', 10)->nullable()->after('nomor_kk');
            $table->string('rw', 10)->nullable()->after('rt');
        });

        Schema::table('kartu_keluarga', function (Blueprint $table) {
            $table->dropForeign(['wilayah_id']);
            $table->foreignId('wilayah_id')->nullable()->change();
            $table->foreign('wilayah_id')->references('id')->on('wilayah')->nullOnDelete();
        });

        DB::statement('UPDATE kartu_keluarga kk LEFT JOIN wilayah w ON kk.wilayah_id = w.id SET kk.rt = w.rt, kk.rw = w.rw');
    }

    public function down(): void
    {
        Schema::table('kartu_keluarga', function (Blueprint $table) {
            $table->dropColumn(['rt', 'rw']);
        });
    }
};
