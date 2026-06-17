<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Kependudukan
            'penduduk.index', 'penduduk.create', 'penduduk.store', 'penduduk.show',
            'penduduk.edit', 'penduduk.update', 'penduduk.destroy',
            'penduduk.import', 'penduduk.export',
            'kartu-keluarga.index', 'kartu-keluarga.create', 'kartu-keluarga.store',
            'kartu-keluarga.show', 'kartu-keluarga.edit', 'kartu-keluarga.update',
            'kartu-keluarga.destroy', 'kartu-keluarga.import', 'kartu-keluarga.export',
            'mutasi.index', 'mutasi.create', 'mutasi.store', 'mutasi.show',
            'mutasi.edit', 'mutasi.update', 'mutasi.destroy',

            // Surat
            'surat.index', 'surat.create', 'surat.store', 'surat.show',
            'surat.cetak', 'surat.destroy',
            'template-surat.index', 'template-surat.create', 'template-surat.store',
            'template-surat.edit', 'template-surat.update',

            // Dashboard
            'dashboard.index',

            // Manajemen User
            'users.index', 'users.create', 'users.store',
            'users.edit', 'users.update', 'users.destroy',

            // Dokumen
            'dokumen-warga.index', 'dokumen-warga.create', 'dokumen-warga.store',
            'dokumen-warga.show', 'dokumen-warga.download', 'dokumen-warga.destroy',
            'dokumen-desa.index', 'dokumen-desa.create', 'dokumen-desa.store',
            'dokumen-desa.show', 'dokumen-desa.download', 'dokumen-desa.destroy',

            // Laporan
            'laporan.penduduk', 'laporan.kk', 'laporan.mutasi', 'laporan.surat',

            // CMS
            'berita.index', 'berita.create', 'berita.store', 'berita.show',
            'berita.edit', 'berita.update', 'berita.destroy',
            'galeri.index', 'galeri.create', 'galeri.store',
            'galeri.edit', 'galeri.update', 'galeri.destroy',
            'potensi-desa.index', 'potensi-desa.create', 'potensi-desa.store',
            'potensi-desa.edit', 'potensi-desa.update', 'potensi-desa.destroy',
            'pengumuman.index', 'pengumuman.create', 'pengumuman.store',
            'pengumuman.edit', 'pengumuman.update', 'pengumuman.destroy',
            'profil-desa.edit', 'profil-desa.update',
            'struktur-organisasi.index', 'struktur-organisasi.create',
            'struktur-organisasi.store', 'struktur-organisasi.edit',
            'struktur-organisasi.update', 'struktur-organisasi.destroy',

            // Sistem
            'backup.index', 'backup.create', 'backup.download', 'backup.destroy',
            'activity-log.index',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $operatorCmsPermissions = [
            'berita.index', 'berita.create', 'berita.store', 'berita.show',
            'berita.edit', 'berita.update', 'berita.destroy',
            'galeri.index', 'galeri.create', 'galeri.store',
            'galeri.edit', 'galeri.update', 'galeri.destroy',
            'potensi-desa.index', 'potensi-desa.create', 'potensi-desa.store',
            'potensi-desa.edit', 'potensi-desa.update', 'potensi-desa.destroy',
            'pengumuman.index', 'pengumuman.create', 'pengumuman.store',
            'pengumuman.edit', 'pengumuman.update', 'pengumuman.destroy',
            'profil-desa.edit', 'profil-desa.update',
            'struktur-organisasi.index', 'struktur-organisasi.create',
            'struktur-organisasi.store', 'struktur-organisasi.edit',
            'struktur-organisasi.update', 'struktur-organisasi.destroy',
        ];

        $operator = Role::create(['name' => 'operator_cms']);
        $operator->givePermissionTo($operatorCmsPermissions);
    }
}
