# DATABASE_SCHEMA.md

# SIPDES ITCI
## Sistem Informasi Penduduk dan Profil Desa ITCI

Versi: 2.0

---

# Tujuan Database

Database SIPDES ITCI dirancang untuk:

- Mengelola data penduduk secara terpusat.
- Mengelola data kartu keluarga.
- Mengelola mutasi penduduk.
- Mengelola surat menyurat desa.
- Menyimpan arsip dokumen warga dan desa.
- Mengelola website profil desa.
- Menyediakan laporan dan statistik.
- Menyimpan histori aktivitas pengguna.
- Mendukung proses import data dari Excel.
- Menyediakan fondasi yang mudah dikembangkan di masa depan.

---

# MASTER DATA

Master data digunakan sebagai referensi untuk menghindari duplikasi data dan mempermudah pembuatan laporan statistik.

---

## Tabel: agama

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_agama | VARCHAR(100) |
| aktif | BOOLEAN |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

### Data Awal

- Islam
- Kristen
- Katolik
- Hindu
- Buddha
- Konghucu

---

## Tabel: pendidikan

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_pendidikan | VARCHAR(100) |
| urutan | INTEGER |
| aktif | BOOLEAN |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

### Data Awal

- Tidak Sekolah
- SD
- SMP
- SMA
- D1
- D2
- D3
- D4
- S1
- S2
- S3

---

## Tabel: pekerjaan

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_pekerjaan | VARCHAR(255) |
| aktif | BOOLEAN |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

---

## Tabel: wilayah

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| rt | VARCHAR(5) |
| rw | VARCHAR(5) |
| nama_wilayah | VARCHAR(255) NULL |
| aktif | BOOLEAN |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

---

## Tabel: jenis_surat

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| kode_surat | VARCHAR(20) |
| nama_surat | VARCHAR(255) |
| deskripsi | TEXT NULL |
| aktif | BOOLEAN |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

### Data Awal

| Kode | Nama |
|-------|-------|
| SKD | Surat Keterangan Domisili |
| SKTM | Surat Keterangan Tidak Mampu |
| SKU | Surat Keterangan Usaha |
| SP | Surat Pengantar |
| SKK | Surat Keterangan Kelahiran |
| SKM | Surat Keterangan Kematian |
| SKP | Surat Keterangan Pindah |

---

# SISTEM

---

## Tabel: pengguna

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama | VARCHAR(255) |
| email | VARCHAR(255) UNIQUE |
| kata_sandi | VARCHAR(255) |
| peran | ENUM(admin, operator_cms) |
| foto_profil | VARCHAR(255) NULL |
| terakhir_login | TIMESTAMP NULL |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

---

## Tabel: aktivitas_sistem

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| pengguna_id | BIGINT FK |
| modul | VARCHAR(100) |
| aktivitas | VARCHAR(255) |
| data_lama | JSON NULL |
| data_baru | JSON NULL |
| alamat_ip | VARCHAR(50) |
| user_agent | TEXT |
| dibuat_pada | TIMESTAMP |

---

## Tabel: backup_database

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_file | VARCHAR(255) |
| ukuran_file | BIGINT |
| lokasi_file | VARCHAR(255) |
| dibuat_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |

---

## Tabel: notifikasi_sistem

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| judul | VARCHAR(255) |
| pesan | TEXT |
| tipe | ENUM(info, sukses, peringatan, error) |
| dibaca | BOOLEAN |
| pengguna_id | BIGINT NULL |
| dibuat_pada | TIMESTAMP |

---

# KEPENDUDUKAN

---

## Tabel: kartu_keluarga

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nomor_kk | VARCHAR(20) UNIQUE |
| wilayah_id | BIGINT FK |
| alamat | TEXT |
| kode_pos | VARCHAR(10) NULL |
| nomor_telepon | VARCHAR(20) NULL |
| kepala_keluarga_id | BIGINT NULL |
| status | ENUM(aktif, tidak_aktif) |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

### Catatan

`kepala_keluarga_id` mengarah ke tabel `penduduk`.

---

## Tabel: penduduk

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| kode_warga | VARCHAR(20) UNIQUE |
| kartu_keluarga_id | BIGINT FK |
| nik | VARCHAR(20) UNIQUE |
| nama_lengkap | VARCHAR(255) |
| tempat_lahir | VARCHAR(100) |
| tanggal_lahir | DATE |
| jenis_kelamin | ENUM(L, P) |
| agama_id | BIGINT FK |
| pendidikan_id | BIGINT FK |
| pekerjaan_id | BIGINT FK |
| status_perkawinan | ENUM |
| golongan_darah | VARCHAR(5) NULL |
| nomor_telepon | VARCHAR(20) NULL |
| hubungan_keluarga | ENUM |
| status_penduduk | ENUM |
| foto | VARCHAR(255) NULL |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

### Status Perkawinan

- belum_kawin
- kawin
- cerai_hidup
- cerai_mati

### Hubungan Keluarga

- kepala_keluarga
- istri
- anak
- orang_tua
- kerabat

### Status Penduduk

- aktif
- pindah
- meninggal
- pendatang

---

## Tabel: mutasi_penduduk

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| penduduk_id | BIGINT FK |
| jenis_mutasi | ENUM(masuk, keluar, meninggal) |
| tanggal_mutasi | DATE |
| asal_tujuan | TEXT |
| alasan | TEXT |
| keterangan | TEXT NULL |
| dibuat_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |

---

# SURAT MENYURAT

---

## Tabel: surat

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nomor_surat | VARCHAR(100) |
| penduduk_id | BIGINT FK |
| jenis_surat_id | BIGINT FK |
| keperluan | TEXT |
| data_snapshot | JSON |
| file_pdf | VARCHAR(255) |
| dicetak_pada | TIMESTAMP |
| dibuat_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |

### Catatan

Kolom `data_snapshot` digunakan untuk menyimpan data warga saat surat diterbitkan sehingga isi surat tidak berubah walaupun data warga berubah di kemudian hari.

---

## Tabel: template_surat

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_template | VARCHAR(255) |
| header_surat | LONGTEXT |
| footer_surat | LONGTEXT |
| penandatangan | VARCHAR(255) |
| jabatan | VARCHAR(255) |
| logo | VARCHAR(255) |
| aktif | BOOLEAN |

---

## Tabel: pengaturan_surat

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| format_nomor | VARCHAR(255) |
| prefix | VARCHAR(50) |
| reset_nomor_tahunan | BOOLEAN |

### Contoh Format

```text
{nomor}/{kode}/{desa}/{bulan}/{tahun}
```

Hasil:

```text
001/SKD/ITCI/VI/2027
```

---

# DOKUMEN

---

## Tabel: dokumen_warga

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| penduduk_id | BIGINT FK |
| jenis_dokumen | VARCHAR(100) |
| nama_file | VARCHAR(255) |
| lokasi_file | VARCHAR(255) |
| ukuran_file | BIGINT |
| dibuat_pada | TIMESTAMP |

---

## Tabel: dokumen_desa

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| kategori | VARCHAR(100) |
| judul | VARCHAR(255) |
| deskripsi | TEXT |
| nama_file | VARCHAR(255) |
| lokasi_file | VARCHAR(255) |
| dibuat_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |

---

# WEBSITE DESA

---

## Tabel: konfigurasi_desa

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_desa | VARCHAR(255) |
| alamat | TEXT |
| telepon | VARCHAR(20) |
| email | VARCHAR(255) |
| logo | VARCHAR(255) |
| nama_kepala_desa | VARCHAR(255) |
| nama_sekretaris | VARCHAR(255) |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

---

## Tabel: profil_desa

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| sejarah | LONGTEXT |
| visi | LONGTEXT |
| misi | LONGTEXT |
| sambutan | LONGTEXT |
| luas_wilayah | VARCHAR(100) |
| batas_utara | VARCHAR(255) |
| batas_selatan | VARCHAR(255) |
| batas_timur | VARCHAR(255) |
| batas_barat | VARCHAR(255) |

---

## Tabel: struktur_organisasi

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama | VARCHAR(255) |
| jabatan | VARCHAR(255) |
| foto | VARCHAR(255) |
| periode_mulai | DATE |
| periode_selesai | DATE NULL |
| urutan | INTEGER |
| deskripsi | TEXT NULL |

---

## Tabel: berita

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| judul | VARCHAR(255) |
| slug | VARCHAR(255) UNIQUE |
| ringkasan | TEXT |
| isi_berita | LONGTEXT |
| gambar_utama | VARCHAR(255) |
| status | ENUM(draft, publish, arsip) |
| dipublikasikan_pada | TIMESTAMP NULL |
| dibuat_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |
| diperbarui_pada | TIMESTAMP |

---

## Tabel: galeri

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| judul | VARCHAR(255) |
| kategori | ENUM(foto, video) |
| file_media | VARCHAR(255) NULL |
| url_youtube | VARCHAR(255) NULL |
| deskripsi | TEXT NULL |
| dibuat_pada | TIMESTAMP |

---

## Tabel: potensi_desa

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| nama_potensi | VARCHAR(255) |
| kategori | VARCHAR(100) |
| deskripsi | LONGTEXT |
| foto | VARCHAR(255) |
| lokasi | VARCHAR(255) |

---

## Tabel: pengumuman

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| judul | VARCHAR(255) |
| isi_pengumuman | LONGTEXT |
| lampiran | VARCHAR(255) NULL |
| status | BOOLEAN |
| dipublikasikan_pada | TIMESTAMP NULL |
| dibuat_oleh | BIGINT FK |

---

# IMPORT DATA EXCEL

---

## Tabel: riwayat_import

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| jenis_import | ENUM(penduduk, kartu_keluarga) |
| nama_file | VARCHAR(255) |
| lokasi_file | VARCHAR(255) |
| total_baris | INTEGER |
| berhasil_import | INTEGER |
| gagal_import | INTEGER |
| status | ENUM(berhasil, sebagian_berhasil, gagal) |
| catatan | TEXT NULL |
| diimpor_oleh | BIGINT FK |
| dibuat_pada | TIMESTAMP |

---

## Tabel: detail_import_error

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| riwayat_import_id | BIGINT FK |
| nomor_baris | INTEGER |
| pesan_error | TEXT |
| data_baris | JSON |
| dibuat_pada | TIMESTAMP |

---

## Tabel: audit_import

| Kolom | Tipe |
|---------|---------|
| id | BIGINT PK |
| riwayat_import_id | BIGINT FK |
| aksi | VARCHAR(100) |
| pengguna_id | BIGINT FK |
| dibuat_pada | TIMESTAMP |

---

# RELASI UTAMA

```text
agama
 └── penduduk

pendidikan
 └── penduduk

pekerjaan
 └── penduduk

wilayah
 └── kartu_keluarga

kartu_keluarga
 └── penduduk

penduduk
 ├── mutasi_penduduk
 ├── surat
 └── dokumen_warga

jenis_surat
 └── surat

pengguna
 ├── berita
 ├── pengumuman
 ├── aktivitas_sistem
 ├── backup_database
 ├── riwayat_import
 ├── audit_import
 └── surat
```

---

# Estimasi Kapasitas

| Data | Estimasi |
|--------|--------|
| Kartu Keluarga | 300 - 500 |
| Penduduk | 1.000 - 2.500 |
| Surat per Tahun | 3.000 - 5.000 |
| Dokumen Digital | 10.000+ |
| Berita | 1.000+ |
| Pengumuman | 1.000+ |

Database ini sudah siap digunakan sebagai fondasi pembangunan SIPDES ITCI menggunakan Laravel 12 + Blade + Tailwind CSS + Vite + MySQL dan masih sangat mudah dikembangkan untuk fitur portal warga, pengajuan surat online, dan aplikasi mobile di masa depan.

# END OF DOCUMENT