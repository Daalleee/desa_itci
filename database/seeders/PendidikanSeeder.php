<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_pendidikan' => 'Tidak Sekolah', 'urutan' => 0],
            ['nama_pendidikan' => 'SD', 'urutan' => 1],
            ['nama_pendidikan' => 'SMP', 'urutan' => 2],
            ['nama_pendidikan' => 'SMA', 'urutan' => 3],
            ['nama_pendidikan' => 'D1', 'urutan' => 4],
            ['nama_pendidikan' => 'D2', 'urutan' => 5],
            ['nama_pendidikan' => 'D3', 'urutan' => 6],
            ['nama_pendidikan' => 'D4', 'urutan' => 7],
            ['nama_pendidikan' => 'S1', 'urutan' => 8],
            ['nama_pendidikan' => 'S2', 'urutan' => 9],
            ['nama_pendidikan' => 'S3', 'urutan' => 10],
        ];

        foreach ($data as $item) {
            Pendidikan::create($item);
        }
    }
}
