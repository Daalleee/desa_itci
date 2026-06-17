<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropForeign(['pekerjaan_id']);
            $table->dropForeign(['pendidikan_id']);
            $table->dropColumn(['pekerjaan_id', 'pendidikan_id']);
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('pekerjaan', 100)->nullable()->after('agama_id');
            $table->string('pendidikan', 100)->nullable()->after('pekerjaan');
        });
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropColumn(['pekerjaan', 'pendidikan']);
        });

        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreignId('pendidikan_id')->constrained('pendidikan');
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan');
        });
    }
};
