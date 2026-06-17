# PROGRES.MD - SIPDES ITCI

> Terakhir diperbarui: 18 Juni 2026
>
> **Sesi 1 Selesai:** Packages ✓ | Migrations ✓ | Models ✓ | Seeders ✓ | Login ✓

---

## Overall Progress

| Fase | Progress |
|------|----------|
| Setup & Infrastruktur | **~60%** |
| Auth & Authorization | **~30%** |
| Fase 1 (KKN) | **~1%** |
| Fase 2 | **0%** |
| Fase 3 | **0%** |
| **Total Proyek** | **~8%** |

---

## A. SETUP & INFRASTRUKTUR

### A.1 Framework & Environment

| # | Task | Status |
|---|------|--------|
| 1 | Laravel 13 instalasi & konfigurasi | [x] |
| 2 | Konfigurasi .env (MySQL, database desa_itci) | [x] |
| 3 | App Key generated | [x] |
| 4 | Vite + Tailwind CSS v4 setup | [x] |
| 5 | Install Spatie Laravel Permission (`composer require spatie/laravel-permission`) | [x] |
| 6 | Install DomPDF (`composer require barryvdh/laravel-dompdf`) | [x] |
| 7 | Install Laravel Excel (`composer require maatwebsite/laravel-excel`) | [x] |
| 8 | Konfigurasi filesystems (local/public storage) | [ ] |
| 9 | Konfigurasi timezone & locale (Indonesia) | [ ] |
| 10 | Setup error handling (custom exception) | [ ] |

### A.2 Database Migrations

#### A.2.1 Default Laravel

| # | Task | Status |
|---|------|--------|
| 1 | Migration users, password_reset_tokens, sessions | [x] |
| 2 | Migration cache, cache_locks | [x] |
| 3 | Migration jobs, job_batches, failed_jobs | [x] |

#### A.2.2 Master Data

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `agama` | [x] |
| 2 | Migration tabel `pendidikan` | [x] |
| 3 | Migration tabel `pekerjaan` | [x] |
| 4 | Migration tabel `wilayah` | [x] |
| 5 | Migration tabel `jenis_surat` | [x] |

#### A.2.3 Sistem

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `aktivitas_sistem` | [x] |
| 2 | Migration tabel `backup_database` | [x] |
| 3 | Migration tabel `notifikasi_sistem` | [x] |
| 4 | Migration Spatie permission tables | [x] |

#### A.2.4 Kependudukan

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `kartu_keluarga` | [x] |
| 2 | Migration tabel `penduduk` | [x] |
| 3 | Migration tabel `mutasi_penduduk` | [x] |

#### A.2.5 Surat Menyurat

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `surat` | [x] |
| 2 | Migration tabel `template_surat` | [x] |
| 3 | Migration tabel `pengaturan_surat` | [x] |

#### A.2.6 Dokumen

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `dokumen_warga` | [x] |
| 2 | Migration tabel `dokumen_desa` | [x] |

#### A.2.7 Website Desa

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `konfigurasi_desa` | [x] |
| 2 | Migration tabel `profil_desa` | [x] |
| 3 | Migration tabel `struktur_organisasi` | [x] |
| 4 | Migration tabel `berita` | [x] |
| 5 | Migration tabel `galeri` | [x] |
| 6 | Migration tabel `potensi_desa` | [x] |
| 7 | Migration tabel `pengumuman` | [x] |

#### A.2.8 Import Excel

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `riwayat_import` | [x] |
| 2 | Migration tabel `detail_import_error` | [x] |
| 3 | Migration tabel `audit_import` | [x] |

### A.3 Models

| # | Task | Status |
|---|------|--------|
| 1 | Model User (update: tambah Spatie traits, relasi) | [x] |
| 2 | Model Agama | [x] |
| 3 | Model Pendidikan | [x] |
| 4 | Model Pekerjaan | [x] |
| 5 | Model Wilayah | [x] |
| 6 | Model JenisSurat | [x] |
| 7 | Model KartuKeluarga | [x] |
| 8 | Model Penduduk | [x] |
| 9 | Model MutasiPenduduk | [x] |
| 10 | Model Surat | [x] |
| 11 | Model TemplateSurat | [x] |
| 12 | Model PengaturanSurat | [x] |
| 13 | Model DokumenWarga | [x] |
| 14 | Model DokumenDesa | [x] |
| 15 | Model KonfigurasiDesa | [x] |
| 16 | Model ProfilDesa | [x] |
| 17 | Model StrukturOrganisasi | [x] |
| 18 | Model Berita | [x] |
| 19 | Model Galeri | [x] |
| 20 | Model PotensiDesa | [x] |
| 21 | Model Pengumuman | [x] |
| 22 | Model AktivitasSistem | [x] |
| 23 | Model BackupDatabase | [x] |
| 24 | Model NotifikasiSistem | [x] |
| 25 | Model RiwayatImport | [x] |
| 26 | Model DetailImportError | [x] |
| 27 | Model AuditImport | [x] |

### A.4 Seeders

| # | Task | Status |
|---|------|--------|
| 1 | AgamaSeeder (Islam, Kristen, Katolik, Hindu, Buddha, Konghucu) | [x] |
| 2 | PendidikanSeeder (Tidak Sekolah, SD, SMP, SMA, D1-D4, S1-S3) | [x] |
| 3 | PekerjaanSeeder (data awal pekerjaan umum) | [x] |
| 4 | WilayahSeeder (RT/RW default) | [x] |
| 5 | JenisSuratSeeder (7 jenis surat) | [x] |
| 6 | RolePermissionSeeder (admin & operator_cms) | [x] |
| 7 | AdminUserSeeder (akun admin default) | [x] |
| 8 | DatabaseSeeder orchestrate (panggil semua seeder) | [x] |

---

## B. AUTHENTICATION & AUTHORIZATION

### B.1 Login System

| # | Task | Status |
|---|------|--------|
| 1 | Install Laravel Breeze atau buat custom auth | [x] |
| 2 | LoginController (authenticate) | [x] |
| 3 | Login view (login.blade.php) | [x] |
| 4 | Login route (GET/POST /login) | [x] |
| 5 | Logout (POST /logout) | [x] |
| 6 | Forgot Password view & controller | [ ] |
| 7 | Reset Password view & controller | [ ] |
| 8 | Middleware redirect if authenticated | [ ] |

### B.2 RBAC (Spatie Permission)

| # | Task | Status |
|---|------|--------|
| 1 | Publish Spatie config & migration | [x] |
| 2 | Konfigurasi guard & permission di config/permission.php | [x] |
| 3 | Seeder: definisi roles (admin, operator_cms) | [x] |
| 4 | Seeder: definisi permissions per modul | [x] |
| 5 | Middleware `role:admin` / `role:operator_cms` | [ ] |
| 6 | Blade directives: @role, @can, @permission | [x] |
| 7 | Gate policies per model | [ ] |

### B.3 User Management

| # | Task | Status |
|---|------|--------|
| 1 | Migration: update users (tambah role, foto, last_login) | [x] |
| 2 | Model User: tambah Spatie traits, casts | [ ] |
| 3 | UserController (index, create, store, edit, update, destroy) | [ ] |
| 4 | View: users/index.blade.php | [ ] |
| 5 | View: users/create.blade.php | [ ] |
| 6 | View: users/edit.blade.php | [ ] |
| 7 | View: users/show.blade.php | [ ] |
| 8 | Routes: resource users | [ ] |
| 9 | StoreUserRequest / UpdateUserRequest | [ ] |

---

## C. FASE 1 (KKN)

### C.1 Dashboard

| # | Task | Status |
|---|------|--------|
| 1 | DashboardController | [x] |
| 2 | View: dashboard/index.blade.php | [x] |
| 3 | Statistik cards: total penduduk, KK, L/P, balita, lansia | [ ] |
| 4 | Statistik administrasi: surat hari ini, bulan ini, penduduk masuk/keluar | [ ] |
| 5 | Statistik website: total berita, pengumuman, galeri | [ ] |
| 6 | Grafik: penduduk berdasarkan umur | [ ] |
| 7 | Grafik: penduduk berdasarkan pendidikan | [ ] |
| 8 | Grafik: penduduk berdasarkan agama | [ ] |
| 9 | Grafik: penduduk berdasarkan pekerjaan | [ ] |
| 10 | Route dashboard (GET /dashboard) | [x] |

### C.2 Data Penduduk

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `penduduk` (lengkap) | [ ] |
| 2 | Model Penduduk (relations: agama, pendidikan, pekerjaan, KK, mutasi) | [ ] |
| 3 | PendudukController (index, create, store, show, edit, update, destroy) | [ ] |
| 4 | View: penduduk/index.blade.php (tabel + search) | [ ] |
| 5 | View: penduduk/create.blade.php | [ ] |
| 6 | View: penduduk/edit.blade.php | [ ] |
| 7 | View: penduduk/show.blade.php (detail warga) | [ ] |
| 8 | Routes: resource penduduk | [ ] |
| 9 | StorePendudukRequest (validasi NIK unique, dll) | [ ] |
| 10 | UpdatePendudukRequest | [ ] |
| 11 | Fitur cari (NIK, Nama, No KK) | [ ] |
| 12 | Import Excel penduduk | [ ] |
| 13 | Export Excel penduduk | [ ] |
| 14 | Export PDF penduduk | [ ] |
| 15 | Soft delete / hapus penduduk | [ ] |

### C.3 Data Kartu Keluarga

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `kartu_keluarga` | [ ] |
| 2 | Migration update: tambah FK kepala_keluarga_id ke penduduk | [ ] |
| 3 | Model KartuKeluarga (relations: wilayah, anggota keluarga) | [ ] |
| 4 | KartuKeluargaController (index, create, store, show, edit, update, destroy) | [ ] |
| 5 | View: kartu-keluarga/index.blade.php | [ ] |
| 6 | View: kartu-keluarga/create.blade.php | [ ] |
| 7 | View: kartu-keluarga/edit.blade.php | [ ] |
| 8 | View: kartu-keluarga/show.blade.php (daftar anggota) | [ ] |
| 9 | Routes: resource kartu-keluarga | [ ] |
| 10 | StoreKartuKeluargaRequest | [ ] |
| 11 | UpdateKartuKeluargaRequest | [ ] |
| 12 | Fitur: tambah anggota keluarga ke KK | [ ] |
| 13 | Fitur: hapus anggota dari KK | [ ] |
| 14 | Fitur: ganti kepala keluarga | [ ] |
| 15 | Export PDF KK | [ ] |
| 16 | Export Excel KK | [ ] |
| 17 | Import Excel KK | [ ] |

### C.4 Mutasi Penduduk

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `mutasi_penduduk` | [ ] |
| 2 | Model MutasiPenduduk (relations: penduduk, user) | [ ] |
| 3 | MutasiController (index, create, store, show) | [ ] |
| 4 | View: mutasi/index.blade.php (filter: masuk/keluar/meninggal) | [ ] |
| 5 | View: mutasi/create.blade.php (pilih penduduk + jenis mutasi) | [ ] |
| 6 | View: mutasi/show.blade.php | [ ] |
| 7 | Routes: resource mutasi | [ ] |
| 8 | StoreMutasiRequest | [ ] |
| 9 | Fitur: mutasi masuk (update status penduduk jadi aktif) | [ ] |
| 10 | Fitur: mutasi keluar (update status penduduk jadi pindah) | [ ] |
| 11 | Fitur: mutasi meninggal (update status penduduk jadi meninggal) | [ ] |
| 12 | Export PDF mutasi | [ ] |
| 13 | Export Excel mutasi | [ ] |

### C.5 Surat Menyurat

#### C.5.0 Setup Surat

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `surat` | [ ] |
| 2 | Migration tabel `template_surat` | [ ] |
| 3 | Migration tabel `pengaturan_surat` | [ ] |
| 4 | Model Surat (relations: penduduk, jenisSurat, user) | [ ] |
| 5 | Model TemplateSurat | [ ] |
| 6 | Model PengaturanSurat | [ ] |
| 7 | SuratController (index, create, store, show, cetak) | [ ] |
| 8 | View: surat/index.blade.php (riwayat semua surat) | [ ] |
| 9 | View: surat/create.blade.php (pilih penduduk + jenis surat) | [ ] |
| 10 | View: surat/show.blade.php | [ ] |
| 11 | Routes: resource surat + custom cetak | [ ] |
| 12 | StoreSuratRequest | [ ] |
| 13 | Sistem nomor surat otomatis (format: 001/SKD/ITCI/VI/2027) | [ ] |
| 14 | Data snapshot (simpan data warga saat surat dicetak) | [ ] |
| 15 | TemplateSuratController (pengaturan logo, header, footer, penandatangan) | [ ] |
| 16 | View: template-surat/index.blade.php | [ ] |
| 17 | View: template-surat/edit.blade.php | [ ] |
| 18 | Pengaturan format nomor surat | [ ] |
| 19 | View: pengaturan-surat/index.blade.php | [ ] |
| 20 | Riwayat Surat (filter by jenis, tanggal, penduduk) | [ ] |

#### C.5.1 Surat Keterangan Domisili (SKD)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/domisili.blade.php | [ ] |
| 2 | Controller method: generateDomisili() | [ ] |
| 3 | Route: cetak SKD | [ ] |
| 4 | Preview PDF SKD | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.2 Surat Keterangan Tidak Mampu (SKTM)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/tidak-mampu.blade.php | [ ] |
| 2 | Controller method: generateTidakMampu() | [ ] |
| 3 | Route: cetak SKTM | [ ] |
| 4 | Preview PDF SKTM | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.3 Surat Pengantar (SP)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/pengantar.blade.php | [ ] |
| 2 | Controller method: generatePengantar() | [ ] |
| 3 | Route: cetak SP | [ ] |
| 4 | Preview PDF SP | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.4 Surat Keterangan Usaha (SKU)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/usaha.blade.php | [ ] |
| 2 | Controller method: generateUsaha() | [ ] |
| 3 | Route: cetak SKU | [ ] |
| 4 | Preview PDF SKU | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.5 Surat Keterangan Kelahiran (SKK)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/kelahiran.blade.php | [ ] |
| 2 | Controller method: generateKelahiran() | [ ] |
| 3 | Route: cetak SKK | [ ] |
| 4 | Preview PDF SKK | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.6 Surat Keterangan Kematian (SKM)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/kematian.blade.php | [ ] |
| 2 | Controller method: generateKematian() | [ ] |
| 3 | Route: cetak SKM | [ ] |
| 4 | Preview PDF SKM | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

#### C.5.7 Surat Keterangan Pindah (SKP)

| # | Task | Status |
|---|------|--------|
| 1 | View cetak: surat/pindah.blade.php | [ ] |
| 2 | Controller method: generatePindah() | [ ] |
| 3 | Route: cetak SKP | [ ] |
| 4 | Preview PDF SKP | [ ] |
| 5 | Generate PDF (DomPDF) | [ ] |

### C.6 Profil Desa

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `konfigurasi_desa` | [ ] |
| 2 | Migration tabel `profil_desa` | [ ] |
| 3 | Model KonfigurasiDesa | [ ] |
| 4 | Model ProfilDesa | [ ] |
| 5 | ProfilDesaController (edit, update) | [ ] |
| 6 | View: profil-desa/edit.blade.php (form: sejarah, visi, misi, sambutan) | [ ] |
| 7 | View: profil-desa/show.blade.php (informasi desa: luas, batas wilayah) | [ ] |
| 8 | Routes: resource profil-desa | [ ] |
| 9 | UpdateProfilDesaRequest | [ ] |
| 10 | Upload logo desa | [ ] |

### C.7 Berita

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `berita` | [ ] |
| 2 | Model Berita (relations: user, scope publish) | [ ] |
| 3 | BeritaController (index, create, store, show, edit, update, destroy) | [ ] |
| 4 | View: berita/index.blade.php (filter: draft/publish) | [ ] |
| 5 | View: berita/create.blade.php | [ ] |
| 6 | View: berita/edit.blade.php | [ ] |
| 7 | View: berita/show.blade.php | [ ] |
| 8 | Routes: resource berita | [ ] |
| 9 | StoreBeritaRequest | [ ] |
| 10 | UpdateBeritaRequest | [ ] |
| 11 | Auto-generate slug dari judul | [ ] |
| 12 | Upload thumbnail berita | [ ] |
| 13 | TinyMCE / text editor untuk konten | [ ] |
| 14 | Fitur draft / publish | [ ] |

### C.8 Galeri

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `galeri` | [ ] |
| 2 | Model Galeri | [ ] |
| 3 | GaleriController (index, create, store, edit, update, destroy) | [ ] |
| 4 | View: galeri/index.blade.php | [ ] |
| 5 | View: galeri/create.blade.php | [ ] |
| 6 | View: galeri/edit.blade.php | [ ] |
| 7 | Routes: resource galeri | [ ] |
| 8 | StoreGaleriRequest | [ ] |
| 9 | UpdateGaleriRequest | [ ] |
| 10 | Upload foto galeri | [ ] |
| 11 | Input URL YouTube untuk video | [ ] |
| 12 | Lightbox / preview foto | [ ] |

### C.9 Potensi Desa

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `potensi_desa` | [ ] |
| 2 | Model PotensiDesa | [ ] |
| 3 | PotensiDesaController (index, create, store, edit, update, destroy) | [ ] |
| 4 | View: potensi-desa/index.blade.php (filter kategori) | [ ] |
| 5 | View: potensi-desa/create.blade.php | [ ] |
| 6 | View: potensi-desa/edit.blade.php | [ ] |
| 7 | Routes: resource potensi-desa | [ ] |
| 8 | StorePotensiDesaRequest | [ ] |
| 9 | UpdatePotensiDesaRequest | [ ] |
| 10 | Upload foto potensi | [ ] |
| 11 | Kategori: Pertanian, Perkebunan, Perikanan, Peternakan, UMKM, Pariwisata | [ ] |

### C.10 Pengumuman

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `pengumuman` | [ ] |
| 2 | Model Pengumuman (relations: user) | [ ] |
| 3 | PengumumanController (index, create, store, edit, update, destroy) | [ ] |
| 4 | View: pengumuman/index.blade.php | [ ] |
| 5 | View: pengumuman/create.blade.php | [ ] |
| 6 | View: pengumuman/edit.blade.php | [ ] |
| 7 | View: pengumuman/show.blade.php | [ ] |
| 8 | Routes: resource pengumuman | [ ] |
| 9 | StorePengumumanRequest | [ ] |
| 10 | UpdatePengumumanRequest | [ ] |
| 11 | Upload lampiran pengumuman | [ ] |
| 12 | Fitur status aktif/non-aktif | [ ] |
| 13 | Fitur tanggal publikasi | [ ] |

---

## D. FASE 2

### D.1 Statistik Lanjutan

| # | Task | Status |
|---|------|--------|
| 1 | DashboardController: method statistik lanjutan | [ ] |
| 2 | Grafik interaktif (Chart.js) | [ ] |
| 3 | Filter periode statistik | [ ] |
| 4 | Export grafik sebagai gambar/PDF | [ ] |
| 5 | Statistik per RT/RW | [ ] |

### D.2 Arsip Dokumen

#### D.2.1 Dokumen Warga

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `dokumen_warga` | [ ] |
| 2 | Model DokumenWarga (relations: penduduk) | [ ] |
| 3 | DokumenWargaController (index, create, store, show, download, destroy) | [ ] |
| 4 | View: dokumen-warga/index.blade.php (filter by penduduk) | [ ] |
| 5 | View: dokumen-warga/create.blade.php | [ ] |
| 6 | View: dokumen-warga/show.blade.php | [ ] |
| 7 | Routes: resource dokumen-warga | [ ] |
| 8 | Upload file (KTP, KK, Akta, dll) | [ ] |
| 9 | Download file | [ ] |
| 10 | Preview file (PDF/image) | [ ] |

#### D.2.2 Dokumen Desa

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `dokumen_desa` | [ ] |
| 2 | Model DokumenDesa (relations: user) | [ ] |
| 3 | DokumenDesaController (index, create, store, show, download, destroy) | [ ] |
| 4 | View: dokumen-desa/index.blade.php (filter kategori) | [ ] |
| 5 | View: dokumen-desa/create.blade.php | [ ] |
| 6 | View: dokumen-desa/show.blade.php | [ ] |
| 7 | Routes: resource dokumen-desa | [ ] |
| 8 | Upload file (PDF, DOC, dll) | [ ] |
| 9 | Kategori: Peraturan Desa, SK, Administrasi | [ ] |

### D.3 Backup Database

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `backup_database` | [ ] |
| 2 | Model BackupDatabase | [ ] |
| 3 | BackupController (index, create, download, destroy) | [ ] |
| 4 | View: backup/index.blade.php | [ ] |
| 5 | Route backup | [ ] |
| 6 | Fitur backup manual (dump SQL) | [ ] |
| 7 | Fitur download file backup | [ ] |
| 8 | Scheduler backup otomatis (mingguan, bulanan) | [ ] |
| 9 | Notifikasi backup selesai/gagal | [ ] |
| 10 | Hapus backup lama (retensi) | [ ] |

### D.4 Activity Log / Audit Trail

| # | Task | Status |
|---|------|--------|
| 1 | Migration tabel `aktivitas_sistem` | [ ] |
| 2 | Model AktivitasSistem | [ ] |
| 3 | ActivityLogController (index, show, export, filter) | [ ] |
| 4 | View: activity-log/index.blade.php (filter: modul, user, tanggal) | [ ] |
| 5 | View: activity-log/show.blade.php | [ ] |
| 6 | Routes activity-log | [ ] |
| 7 | Middleware/Trait otomatis log semua aktivitas CRUD | [ ] |
| 8 | Export activity log | [ ] |

---

## E. FASE 3

### E.1 Portal Warga (Halaman Depan Publik)

| # | Task | Status |
|---|------|--------|
| 1 | Landing page view (publik) | [ ] |
| 2 | Layout publik (navbar, footer) | [ ] |
| 3 | Halaman profil desa (publik) | [ ] |
| 4 | Halaman berita (publik, pagination) | [ ] |
| 5 | Halaman detail berita (publik) | [ ] |
| 6 | Halaman galeri (publik) | [ ] |
| 7 | Halaman potensi desa (publik) | [ ] |
| 8 | Halaman pengumuman (publik) | [ ] |
| 9 | Halaman struktur organisasi (publik) | [ ] |
| 10 | Halaman kontak desa | [ ] |
| 11 | Route publik | [ ] |

### E.2 Pengajuan Surat Online

| # | Task | Status |
|---|------|--------|
| 1 | Migration: tambah status di tabel surat (menunggu, diproses, selesai) | [ ] |
| 2 | Form warga: ajukan surat online | [ ] |
| 3 | View: cek status pengajuan (masukkan no registrasi) | [ ] |
| 4 | Notifikasi ke admin: ada pengajuan baru | [ ] |
| 5 | Admin: approve/tolak pengajuan | [ ] |
| 6 | Warga: download surat hasil cetak | [ ] |

### E.3 Notifikasi WhatsApp

| # | Task | Status |
|---|------|--------|
| 1 | Setup API WhatsApp Gateway (Fonnte / Wabox) | [ ] |
| 2 | Notifikasi: surat selesai | [ ] |
| 3 | Notifikasi: pengajuan diterima | [ ] |
| 4 | Notifikasi: backup selesai | [ ] |
| 5 | Konfigurasi nomor WhatsApp | [ ] |

### E.4 Aplikasi Mobile (API)

| # | Task | Status |
|---|------|--------|
| 1 | API Auth (login, logout, refresh token) | [ ] |
| 2 | API Penduduk (index, show) | [ ] |
| 3 | API Surat (index, show, create) | [ ] |
| 4 | API Berita (index, show) | [ ] |
| 5 | API Galeri (index, show) | [ ] |
| 6 | API Pengumuman (index, show) | [ ] |
| 7 | API ProfilDesa | [ ] |
| 8 | API Rate limiting | [ ] |
| 9 | Dokumentasi API (Swagger/Postman) | [ ] |

---

## F. LAPORAN

### F.1 Laporan Penduduk

| # | Task | Status |
|---|------|--------|
| 1 | Controller: method laporanPenduduk() | [ ] |
| 2 | View: laporan/penduduk/index.blade.php (filter: jenis kelamin, agama, pendidikan, dll) | [ ] |
| 3 | Route laporan penduduk | [ ] |
| 4 | Export PDF laporan penduduk | [ ] |
| 5 | Export Excel laporan penduduk | [ ] |

### F.2 Laporan KK

| # | Task | Status |
|---|------|--------|
| 1 | Controller: method laporanKk() | [ ] |
| 2 | View: laporan/kk/index.blade.php (filter: wilayah/RT/RW) | [ ] |
| 3 | Route laporan KK | [ ] |
| 4 | Export PDF laporan KK | [ ] |
| 5 | Export Excel laporan KK | [ ] |

### F.3 Laporan Mutasi

| # | Task | Status |
|---|------|--------|
| 1 | Controller: method laporanMutasi() | [ ] |
| 2 | View: laporan/mutasi/index.blade.php (filter: jenis mutasi, periode) | [ ] |
| 3 | Route laporan mutasi | [ ] |
| 4 | Export PDF laporan mutasi | [ ] |
| 5 | Export Excel laporan mutasi | [ ] |

### F.4 Laporan Surat

| # | Task | Status |
|---|------|--------|
| 1 | Controller: method laporanSurat() | [ ] |
| 2 | View: laporan/surat/index.blade.php (filter: jenis surat, periode, petugas) | [ ] |
| 3 | Route laporan surat | [ ] |
| 4 | Export PDF laporan surat | [ ] |
| 5 | Export Excel laporan surat | [ ] |

---

## G. LAYOUT & UI

| # | Task | Status |
|---|------|--------|
| 1 | Layout admin (sidebar, navbar, content area) | [x] |
| 2 | Layout publik (header, footer, content) | [ ] |
| 3 | Layout auth (login, register) | [x] |
| 4 | Komponen sidebar menu (collapsible, active state) | [ ] |
| 5 | Komponen navbar (user dropdown, notifikasi) | [ ] |
| 6 | Komponen tabel (sort, search, pagination) | [ ] |
| 7 | Komponen form (input, select, datepicker, file upload) | [ ] |
| 8 | Komponen modal (confirm delete, form modal) | [ ] |
| 9 | Komponen kartu statistik (dashboard) | [ ] |
| 10 | Responsive design (mobile friendly) | [ ] |
| 11 | Dark mode (opsional) | [ ] |

---

## H. TESTING

### H.1 Unit Test

| # | Task | Status |
|---|------|--------|
| 1 | Unit test Model Agama | [ ] |
| 2 | Unit test Model Pendidikan | [ ] |
| 3 | Unit test Model Pekerjaan | [ ] |
| 4 | Unit test Model Wilayah | [ ] |
| 5 | Unit test Model KartuKeluarga | [ ] |
| 6 | Unit test Model Penduduk | [ ] |
| 7 | Unit test Model MutasiPenduduk | [ ] |
| 8 | Unit test Model Surat | [ ] |
| 9 | Unit test Model Berita | [ ] |
| 10 | Unit test Model Galeri | [ ] |
| 11 | Unit test Model PotensiDesa | [ ] |
| 12 | Unit test Model Pengumuman | [ ] |

### H.2 Feature Test

| # | Task | Status |
|---|------|--------|
| 1 | Feature test Login | [ ] |
| 2 | Feature test Data Penduduk (CRUD) | [ ] |
| 3 | Feature test Data KK (CRUD) | [ ] |
| 4 | Feature test Mutasi Penduduk | [ ] |
| 5 | Feature test Surat (generate) | [ ] |
| 6 | Feature test Berita (CRUD) | [ ] |
| 7 | Feature test Galeri | [ ] |
| 8 | Feature test Potensi Desa | [ ] |
| 9 | Feature test Pengumuman | [ ] |
| 10 | Feature test Profil Desa | [ ] |
| 11 | Feature test Import Excel | [ ] |
| 12 | Feature test Export Excel/PDF | [ ] |
| 13 | Feature test RBAC (akses admin vs operator) | [ ] |

---

## RINGKASAN

| Area | Total Task | Selesai | Progress |
|------|-----------|---------|----------|
| A. Setup & Infrastruktur | ~65 | 5 | **~8%** |
| B. Auth & Authorization | ~25 | 0 | **0%** |
| C. Fase 1 (KKN) | ~145 | 0 | **0%** |
| D. Fase 2 | ~40 | 0 | **0%** |
| E. Fase 3 | ~35 | 0 | **0%** |
| F. Laporan | ~20 | 0 | **0%** |
| G. Layout & UI | ~12 | 0 | **0%** |
| H. Testing | ~25 | 0 | **0%** |
| **Total** | **~367** | **5** | **~1.4%** |

---

> **Cara menggunakan:** Centang `[x]` pada task yang sudah selesai. Perbarui persentase di header setiap kali selesai mengerjakan satu sesi.
