<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_surat' => 'SKD', 'nama_surat' => 'Surat Keterangan Domisili'],
            ['kode_surat' => 'SKTM', 'nama_surat' => 'Surat Keterangan Tidak Mampu'],
            ['kode_surat' => 'SKU', 'nama_surat' => 'Surat Keterangan Usaha'],
            ['kode_surat' => 'SP', 'nama_surat' => 'Surat Pengantar'],
            ['kode_surat' => 'SKK', 'nama_surat' => 'Surat Keterangan Kelahiran'],
            ['kode_surat' => 'SKM', 'nama_surat' => 'Surat Keterangan Kematian'],
            ['kode_surat' => 'SKP', 'nama_surat' => 'Surat Keterangan Pindah'],
        ];

        foreach ($data as $item) {
            JenisSurat::create($item);
        }
    }
}
