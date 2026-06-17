<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Belum/Tidak Bekerja', 'Petani', 'Nelayan', 'Pedagang', 'PNS',
            'TNI/Polri', 'Karyawan Swasta', 'Wiraswasta', 'Guru', 'Dosen',
            'Dokter', 'Perawat', 'Supir', 'Tukang', 'Buruh Harian Lepas',
            'IRT', 'Pensiunan', 'Lainnya',
        ];

        foreach ($data as $item) {
            Pekerjaan::create(['nama_pekerjaan' => $item]);
        }
    }
}
