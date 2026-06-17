# REVISI ARSITEKTUR SIPDES ITCI

Lakukan revisi pada seluruh dokumentasi dan implementasi sistem SIPDES ITCI berdasarkan keputusan berikut.

## PERUBAHAN UTAMA

Secara database, tabel tetap dipisahkan menjadi:

- kartu_keluarga
- penduduk

Namun pada sisi UI/UX dan alur aplikasi, pengguna TIDAK BOLEH melihat konsep tabel database tersebut secara terpisah.

Sistem harus berorientasi pada "Keluarga" karena perangkat desa berpikir berdasarkan keluarga, bukan berdasarkan tabel database.

---

# MODUL BARU

Ubah modul:

Data Kependudukan
├── Penduduk
├── Kartu Keluarga

Menjadi:

Data Keluarga
├── Daftar Keluarga

Menu Penduduk dan Kartu Keluarga tidak ditampilkan di sidebar.

---

# ALUR TAMBAH DATA BARU

Hapus alur:

Tambah KK
↓
Tambah Penduduk
↓
Tambah Penduduk

Ganti menjadi:

Tambah Keluarga Baru
↓
Informasi KK
↓
Kepala Keluarga
↓
Anggota Keluarga
↓
Simpan

Satu proses selesai.

---

# FORM TAMBAH KELUARGA

Gunakan Wizard / Multi Step Form.

## STEP 1 - INFORMASI KELUARGA

Field:

- Nomor KK
- RT
- RW
- Alamat
- Kode Pos
- Nomor Telepon

---

## STEP 2 - KEPALA KELUARGA

Field:

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

Field hubungan keluarga otomatis:

Kepala Keluarga

Tidak perlu dipilih.

---

## STEP 3 - ANGGOTA KELUARGA

Gunakan Dynamic Repeater.

Tombol:

+ Tambah Anggota

Setiap anggota memiliki:

- NIK
- Nama Lengkap
- Tempat Lahir
- Tanggal Lahir
- Jenis Kelamin
- Agama
- Pendidikan
- Pekerjaan
- Status Perkawinan

Lalu pilih:

Hubungan Keluarga

Pilihan:

- Istri
- Anak
- Orang Tua
- Kerabat

---

# DYNAMIC FORM

Jika memilih:

## Anak

Munculkan field tambahan:

Status Anak

Pilihan:

- Anak Kandung
- Anak Angkat
- Anak Tiri

---

## Orang Tua

Munculkan:

Hubungan Orang Tua

Pilihan:

- Ayah
- Ibu
- Mertua

---

## Kerabat

Munculkan:

Hubungan Kerabat

Pilihan:

- Paman
- Bibi
- Sepupu
- Keponakan
- Lainnya

Jika memilih Lainnya:

Munculkan input:

Hubungan Kerabat Lainnya

---

# HALAMAN DAFTAR KELUARGA

Tampilkan:

- Nomor KK
- Nama Kepala Keluarga
- Jumlah Anggota
- RT/RW
- Status

Action:

- Detail
- Edit
- Hapus

---

# HALAMAN DETAIL KELUARGA

Jangan gunakan tabel biasa.

Gunakan layout berbasis keluarga.

Contoh:

Nomor KK

Alamat

RT/RW

---------------------

Kepala Keluarga

Nama
NIK

---------------------

Istri

Nama
NIK

---------------------

Anak

Nama
NIK

Nama
NIK

---------------------

Kerabat

Nama
NIK

---

# TAMBAH ANGGOTA KELUARGA

Dari halaman detail keluarga.

Tombol:

Tambah Anggota

Gunakan Modal atau Drawer.

Admin tidak perlu mengisi nomor KK lagi.

Sistem otomatis menghubungkan anggota ke keluarga yang sedang dibuka.

---

# IMPORT EXCEL

Tetap dipisahkan menjadi:

- Import Kartu Keluarga
- Import Penduduk

Karena data migrasi Excel biasanya terpisah.

Namun setelah data masuk sistem:

Admin hanya berinteraksi dengan modul Data Keluarga.

---

# SIDEBAR BARU ADMIN

Dashboard

Data Keluarga
├── Daftar Keluarga
├── Mutasi Penduduk

Surat Menyurat
├── Buat Surat
├── Riwayat Surat
├── Template Surat

Dokumen
├── Arsip Warga
├── Arsip Desa

Pengaturan
├── Pengguna
├── Import Excel
├── Backup Database
├── Aktivitas Sistem

---

# UI/UX

Gunakan:

- Laravel Blade
- TailwindCSS
- Vite
- AlpineJS

Layout:

- Sidebar kiri
- Navbar atas
- Content Area

Gunakan:

- Card
- Stat Card
- Data Table
- Modal
- Drawer
- Wizard Form

Prioritaskan kemudahan penggunaan bagi perangkat desa yang tidak memiliki latar belakang teknis.

Hindari tampilan yang terlalu teknis atau terlalu banyak menu.

Fokus pada alur kerja yang sederhana, cepat dipahami, dan minim kesalahan input.

---

# DATABASE

JANGAN ubah struktur database utama.

Tetap gunakan:

- kartu_keluarga
- penduduk

Perubahan hanya pada layer UI/UX, route, service, dan business flow.

Database tetap dinormalisasi dengan baik.
