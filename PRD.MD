# Product Requirements Document (PRD)

# SIPDES ITCI
## Sistem Informasi Penduduk dan Profil Desa ITCI

---

# Informasi Dokumen

| Informasi | Detail |
|------------|----------|
| Nama Produk | SIPDES ITCI |
| Kepanjangan | Sistem Informasi Penduduk dan Profil Desa ITCI |
| Jenis Aplikasi | Web Application |
| Platform | Website |
| Backend | Laravel  |
| Frontend | Blade + Tailwind CSS |
| Build Tool | Vite |
| Database | MySQL |
| Authorization | Spatie Laravel Permission |
| PDF Generator | DomPDF |
| Excel Import Export | Laravel Excel |
| Storage | Laravel Filesystem |
| Lokasi Implementasi | Desa/Stasi ITCI, Penajam Paser Utara, Kalimantan Timur |

---

# 1. Latar Belakang

Saat ini pengelolaan data warga di Desa/Stasi ITCI masih dilakukan menggunakan Microsoft Excel.

Metode tersebut menimbulkan beberapa kendala, antara lain:

- Data tersebar di banyak file.
- Sulit melakukan pencarian data warga.
- Sulit melakukan rekapitulasi data.
- Berpotensi terjadi duplikasi data.
- Tidak memiliki sistem backup yang terintegrasi.
- Sulit membuat laporan secara cepat.
- Pembuatan surat masih dilakukan secara manual.
- Informasi profil desa belum terkelola secara digital.

Kondisi tersebut menyebabkan proses administrasi menjadi lambat, kurang efisien, dan berisiko kehilangan data.

Oleh karena itu diperlukan sebuah sistem berbasis web yang mampu mengelola data penduduk secara terpusat, aman, dan mudah digunakan oleh petugas desa.

---

# 2. Tujuan Sistem

## Tujuan Utama

Membangun sistem informasi berbasis web yang digunakan untuk mengelola seluruh data administrasi desa secara digital dalam satu platform terintegrasi.

---

## Tujuan Khusus

### Digitalisasi Data Warga

Mengubah pengelolaan data warga yang sebelumnya menggunakan file Excel menjadi sistem database terpusat.

### Mempermudah Pencarian Data

Petugas dapat menemukan data warga hanya dalam hitungan detik berdasarkan:

- Nama
- NIK
- Nomor KK
- Alamat

### Mempermudah Pembuatan Surat

Petugas tidak perlu lagi mengetik ulang data warga untuk setiap surat yang dibuat.

### Menyediakan Laporan Otomatis

Sistem mampu menghasilkan laporan:

- Data Penduduk
- Data KK
- Mutasi Penduduk
- Statistik Penduduk
- Riwayat Surat

### Menjadi Arsip Digital Desa

Menyimpan dokumen penting warga secara aman dan terstruktur.

### Menjadi Media Informasi Desa

Website dapat digunakan untuk menampilkan:

- Profil Desa
- Berita
- Pengumuman
- Potensi Desa
- Galeri Kegiatan

### Mengurangi Ketergantungan pada Excel

Excel hanya digunakan untuk proses import dan export data.

---

# 3. Visi Produk

Menjadi sistem informasi desa yang sederhana, modern, mudah digunakan, dan mampu mendukung digitalisasi administrasi Desa ITCI secara berkelanjutan.

---

# 4. Misi Produk

- Menyediakan data warga yang akurat dan terpusat.
- Mempercepat pelayanan administrasi desa.
- Mempermudah pembuatan surat.
- Menyediakan laporan secara otomatis.
- Menjadi pusat informasi resmi desa.
- Mendukung transformasi digital desa.

---

# 5. Target Pengguna

## Administrator

Petugas desa yang bertanggung jawab mengelola data administrasi.

---

## Operator CMS

Petugas yang bertugas mengelola informasi dan konten website desa.

---

# 6. Ruang Lingkup Sistem

## Modul Kependudukan

- Data Penduduk
- Data Kartu Keluarga
- Mutasi Penduduk

## Modul Surat Menyurat

- Surat Domisili
- Surat Tidak Mampu
- Surat Pengantar
- Surat Keterangan Usaha
- Surat Kelahiran
- Surat Kematian
- Surat Pindah

## Modul Arsip

- Arsip Dokumen Warga
- Arsip Dokumen Desa

## Modul CMS

- Profil Desa
- Struktur Organisasi
- Berita
- Galeri
- Potensi Desa
- Pengumuman

## Modul Administrasi

- User Management
- Backup Database
- Activity Log
- Dashboard Statistik

---

# 7. Role Pengguna

## Administrator

### Hak Akses

- Dashboard
- Data Penduduk
- Data KK
- Mutasi Penduduk
- Surat Menyurat
- Arsip Dokumen
- Laporan
- User Management
- Backup Database
- Activity Log
- Pengaturan Sistem

---

## Operator CMS

### Hak Akses

- Profil Desa
- Struktur Organisasi
- Berita
- Galeri
- Potensi Desa
- Pengumuman

### Tidak Memiliki Akses

- Data Penduduk
- Data KK
- Mutasi
- Surat Menyurat
- Dokumen Warga
- Backup Database
- Pengaturan Sistem

---

# 8. Struktur Menu Administrator

```text
Dashboard

Kependudukan
├── Data Penduduk
├── Data Kartu Keluarga
├── Mutasi Penduduk

Surat Menyurat
├── Surat Domisili
├── Surat Tidak Mampu
├── Surat Pengantar
├── Surat Keterangan Usaha
├── Surat Kelahiran
├── Surat Kematian
├── Surat Pindah
├── Riwayat Surat

Dokumen
├── Arsip Dokumen Warga
├── Arsip Dokumen Desa

Laporan
├── Laporan Penduduk
├── Laporan KK
├── Laporan Mutasi
├── Laporan Surat

Pengaturan
├── Template Surat
├── Manajemen User
├── Backup Database
├── Activity Log
```

---

# 9. Struktur Menu Operator CMS

```text
Dashboard CMS

Website Desa
├── Profil Desa
├── Struktur Organisasi
├── Berita
├── Galeri
├── Potensi Desa
├── Pengumuman
```

---

# 10. Modul Dashboard

## Statistik Penduduk

- Total Penduduk
- Total KK
- Total Laki-Laki
- Total Perempuan
- Total Balita
- Total Lansia

## Statistik Administrasi

- Surat Hari Ini
- Surat Bulan Ini
- Penduduk Masuk
- Penduduk Keluar

## Statistik Website

- Total Berita
- Total Pengumuman
- Total Galeri

## Grafik

- Penduduk Berdasarkan Umur
- Penduduk Berdasarkan Pendidikan
- Penduduk Berdasarkan Agama
- Penduduk Berdasarkan Pekerjaan

---

# 11. Modul Data Penduduk

## Fitur

- Tambah Penduduk
- Edit Penduduk
- Hapus Penduduk
- Detail Penduduk
- Import Excel
- Export Excel
- Export PDF

## Data Penduduk

- NIK
- Nama Lengkap
- Tempat Lahir
- Tanggal Lahir
- Jenis Kelamin
- Agama
- Pendidikan
- Pekerjaan
- Status Perkawinan
- Golongan Darah
- Nomor Telepon
- Nomor KK
- Hubungan Keluarga
- Status Penduduk

---

# 12. Modul Data Kartu Keluarga

## Fitur

- Tambah KK
- Edit KK
- Hapus KK
- Detail KK
- Export PDF
- Export Excel

## Data

- Nomor KK
- Kepala Keluarga
- Alamat
- RT
- RW
- Nomor Telepon

---

# 13. Modul Mutasi Penduduk

## Penduduk Masuk

- Tanggal Masuk
- Asal Daerah
- Keterangan

## Penduduk Keluar

- Tanggal Keluar
- Tujuan
- Keterangan

## Penduduk Meninggal

- Tanggal Meninggal
- Penyebab
- Keterangan

---

# 14. Modul Surat Menyurat

## Tujuan

Mempercepat pelayanan administrasi dengan menghasilkan surat secara otomatis berdasarkan data warga.

---

## Jenis Surat

### Surat Keterangan Domisili

### Surat Keterangan Tidak Mampu

### Surat Pengantar

### Surat Keterangan Usaha

### Surat Keterangan Kelahiran

### Surat Keterangan Kematian

### Surat Keterangan Pindah

---

## Fitur Surat

### Generate Otomatis

Alur:

```text
Cari Penduduk
↓
Pilih Surat
↓
Data Terisi Otomatis
↓
Preview
↓
Cetak PDF
```

### Nomor Surat Otomatis

Contoh:

```text
001/SKD/ITCI/I/2027
```

### Template Surat

Admin dapat mengatur:

- Logo
- Header
- Footer
- Penandatangan
- Stempel Digital (opsional)

### Riwayat Surat

Menyimpan:

- Nomor Surat
- Jenis Surat
- Nama Warga
- Tanggal Cetak
- Petugas

---

# 15. Modul Arsip Dokumen

## Dokumen Warga

- KTP
- KK
- Akta Kelahiran
- Akta Kematian
- Surat Nikah

## Dokumen Desa

- Peraturan Desa
- SK
- Dokumen Administrasi

---

# 16. Modul Profil Desa

## Profil

- Sejarah Desa
- Visi
- Misi
- Sambutan Kepala Desa

## Informasi Desa

- Luas Wilayah
- Jumlah Penduduk
- Jumlah KK
- Batas Wilayah

---

# 17. Modul Struktur Organisasi

Data:

- Nama
- Jabatan
- Foto
- Periode Jabatan
- Deskripsi

---

# 18. Modul Berita

Fitur:

- Draft
- Publish
- Edit
- Hapus

Data:

- Judul
- Slug
- Thumbnail
- Konten
- Penulis

---

# 19. Modul Galeri

## Galeri Foto

- Judul
- Foto
- Deskripsi

## Galeri Video

- Judul
- URL YouTube
- Deskripsi

---

# 20. Modul Potensi Desa

Kategori:

- Pertanian
- Perkebunan
- Perikanan
- Peternakan
- UMKM
- Pariwisata

---

# 21. Modul Pengumuman

Data:

- Judul
- Isi
- Lampiran
- Status
- Tanggal Publikasi

---

# 22. Import dan Export Excel

## Import

- Data Penduduk
- Data KK

## Validasi

- NIK Duplikat
- KK Duplikat
- Format Tanggal
- Data Kosong

## Export

- Excel (.xlsx)
- PDF

---

# 23. Backup Database

## Backup Manual

Administrator dapat mengunduh file backup database.

## Backup Otomatis

- Mingguan
- Bulanan

---

# 24. Activity Log

Sistem wajib mencatat seluruh aktivitas pengguna.

Contoh:

```text
Admin menambahkan data penduduk.
Admin mencetak Surat Domisili.
Admin menghapus data KK.
CMS mempublikasikan berita.
```

---

# 25. Non Functional Requirements

## Performance

- Respon maksimal 3 detik.
- Mendukung minimal 5.000 data penduduk.

## Security

- Authentication
- Authorization
- Password Hashing
- CSRF Protection
- Rate Limiting

## Availability

- Uptime minimal 99%.

## Backup

- Backup otomatis.

---

# 26. Kriteria Keberhasilan

Sistem dianggap berhasil apabila:

- Data warga tidak lagi dikelola menggunakan Excel sebagai sumber utama.
- Pencarian data warga dapat dilakukan kurang dari 10 detik.
- Surat dapat dibuat dalam kurang dari 1 menit.
- Laporan dapat dihasilkan secara otomatis.
- Website desa dapat diperbarui tanpa bantuan programmer.
- Seluruh data tersimpan dalam database terpusat dan memiliki backup rutin.

---

# 27. Roadmap Pengembangan

## Fase 1 (KKN)

- Login
- Dashboard
- Data Penduduk
- Data KK
- Mutasi Penduduk
- Surat Menyurat
- Profil Desa
- Berita
- Galeri
- User Management

## Fase 2

- Statistik Lanjutan
- Arsip Dokumen
- Backup Otomatis
- Audit Trail

## Fase 3

- Portal Warga
- Pengajuan Surat Online
- Notifikasi WhatsApp
- Aplikasi Mobile

---

END OF DOCUMENT