<?php

namespace Database\Seeders;

use App\Models\Agama;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    public function run(): void
    {
        $agamaIds = Agama::pluck('id')->toArray();

        $namaKepala = [
            'AGUS SETIAWAN', 'BAMBANG SUPRIYADI', 'CANDRA KUSUMA',
            'DEDI IRWANTO', 'EDI SUSANTO', 'FAISAL RAHMAN',
            'GUNTUR WICAKSONO', 'HENDRA GUNAWAN', 'IRWAN SYAH',
            'JOKO PRASETYO',
        ];

        $namaIstri = [
            'SITI AISYAH', 'DEWI SARTIKA', 'RINI KUSUMAWATI',
            'FITRIANI', 'YULI ASTUTI', 'NURUL HIDAYAH',
            'SRI WAHYUNI', 'MARIA ULFA', 'RATNA SARI',
            'LINA MARLINA',
        ];

        $namaAnakPool = [
            'AHMAD', 'BAGAS', 'CIPTA', 'DANANG', 'EKO',
            'FAJAR', 'GALIH', 'HARI', 'INDRA', 'JAYA',
            'SITI', 'DEWI', 'RINA', 'NINA', 'TUTI',
            'WULAN', 'YUNI', 'ZAHRA', 'AYU', 'LESTARI',
        ];

        $tempatLahir = ['PENAJAM', 'BALIKPAPAN', 'SAMARINDA', 'TANJUNG REDEB', 'JAKARTA'];
        $pendidikanList = ['SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2', ''];
        $pekerjaanList = ['Petani', 'PNS', 'Wiraswasta', 'Nelayan', 'Pedagang', 'Karyawan Swasta', 'Buruh', 'Guru', ''];

        for ($i = 0; $i < 10; $i++) {
            $kk = KartuKeluarga::create([
                'nomor_kk' => '720801' . str_pad((1000000000 + $i), 10, '0', STR_PAD_LEFT),
                'rt' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 5), 2, '0', STR_PAD_LEFT),
                'alamat' => 'Jl. Poros ITCI Gang ' . chr(65 + $i) . ' No. ' . rand(1, 50),
                'kode_pos' => '76111',
                'nomor_telepon' => '0812' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'status' => 'aktif',
            ]);

            $kepala = Penduduk::create([
                'kartu_keluarga_id' => $kk->id,
                'kode_warga' => 'WRG-' . str_pad($kk->id * 10 + 1, 5, '0', STR_PAD_LEFT),
                'nik' => '720801' . str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'nama_lengkap' => $namaKepala[$i],
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => now()->subYears(rand(30, 55))->subDays(rand(1, 365)),
                'jenis_kelamin' => 'L',
                'agama_id' => $agamaIds[array_rand($agamaIds)],
                'pendidikan' => $pendidikanList[array_rand($pendidikanList)],
                'pekerjaan' => $pekerjaanList[array_rand($pekerjaanList)],
                'status_perkawinan' => 'kawin',
                'golongan_darah' => ['A', 'B', 'AB', 'O'][array_rand(['A', 'B', 'AB', 'O'])],
                'nomor_telepon' => '0821' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'hubungan_keluarga' => 'kepala_keluarga',
                'status_penduduk' => 'aktif',
            ]);

            $kk->update(['kepala_keluarga_id' => $kepala->id]);

            Penduduk::create([
                'kartu_keluarga_id' => $kk->id,
                'kode_warga' => 'WRG-' . str_pad($kk->id * 10 + 2, 5, '0', STR_PAD_LEFT),
                'nik' => '720801' . str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'nama_lengkap' => $namaIstri[$i],
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => now()->subYears(rand(25, 50))->subDays(rand(1, 365)),
                'jenis_kelamin' => 'P',
                'agama_id' => $agamaIds[array_rand($agamaIds)],
                'pendidikan' => $pendidikanList[array_rand($pendidikanList)],
                'pekerjaan' => $pekerjaanList[array_rand($pekerjaanList)],
                'status_perkawinan' => 'kawin',
                'golongan_darah' => ['A', 'B', 'AB', 'O'][array_rand(['A', 'B', 'AB', 'O'])],
                'nomor_telepon' => '0852' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'hubungan_keluarga' => 'istri',
                'status_penduduk' => 'aktif',
            ]);

            $jumlahAnak = rand(1, 3);
            for ($j = 0; $j < $jumlahAnak; $j++) {
                $nama = $namaAnakPool[array_rand($namaAnakPool)];
                $jk = rand(0, 1) ? 'L' : 'P';
                Penduduk::create([
                    'kartu_keluarga_id' => $kk->id,
                    'kode_warga' => 'WRG-' . str_pad($kk->id * 10 + 3 + $j, 5, '0', STR_PAD_LEFT),
                    'nik' => '720801' . str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                    'nama_lengkap' => $nama . ' ' . ($j === 0 ? 'PRATAMA' : ($j === 1 ? 'UTAMA' : 'TAMA')),
                    'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                    'tanggal_lahir' => now()->subYears(rand(2, 17))->subDays(rand(1, 365)),
                    'jenis_kelamin' => $jk,
                    'agama_id' => $agamaIds[array_rand($agamaIds)],
                    'pendidikan' => ['', '', 'SD', 'SMP', 'SMA/SMK'][array_rand(['', '', 'SD', 'SMP', 'SMA/SMK'])],
                    'pekerjaan' => '',
                    'status_perkawinan' => 'belum_kawin',
                    'golongan_darah' => ['A', 'B', 'AB', 'O'][array_rand(['A', 'B', 'AB', 'O'])],
                    'nomor_telepon' => '',
                    'hubungan_keluarga' => 'anak_kandung',
                    'status_penduduk' => 'aktif',
                ]);
            }
        }

        $this->command->info('10 Keluarga berhasil di-seed!');
    }
}
