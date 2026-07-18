# Sistem Informasi Pendaftaran & Seleksi Anggota Paskibra (Tugas Akhir)

Sistem Informasi berbasis web untuk mengelola pendaftaran dan seleksi calon anggota baru Paskibra. Aplikasi ini dikembangkan menggunakan **Laravel 12**, **Tailwind CSS v4**, dan **Vite**, serta dilengkapi dengan fitur perhitungan nilai seleksi berdasarkan kriteria berbobot untuk membantu pengurus menentukan kelulusan peserta secara objektif.

Sistem ini dirancang khusus untuk memenuhi kebutuhan proyek Tugas Akhir (TA Web) dengan arsitektur multi-role dan desain antarmuka yang modern, responsif, dan dinamis.

---

## Fitur Utama

Aplikasi ini memiliki sistem otorisasi multi-role yang membagi akses ke dalam 3 jenis akun:

### 1. Fitur Publik (Pengunjung)
* **Landing Page**: Halaman utama yang interaktif menampilkan profil singkat Paskibra.
* **Profil Organisasi**: Halaman sejarah, visi & misi, serta struktur organisasi.
* **Berita & Pengumuman**: Artikel berita terbaru seputar kegiatan Paskibra dengan slug dinamis.
* **Jadwal Kegiatan**: Kalender/daftar kegiatan Paskibra yang sedang berjalan atau akan datang.
* **Galeri Foto**: Dokumentasi album kegiatan Paskibra berdasarkan tanggal pelaksanaan.

### 2. Dashboard Calon Anggota (Pendaftar)
* **Formulir Pendaftaran**: Mengisi data diri lengkap, data orang tua/wali, serta unggahan berkas persyaratan secara terintegrasi.
* **Status Seleksi**: Memantau perkembangan status verifikasi formulir dan kelulusan secara real-time.
* **Notifikasi Sistem**: Menerima pembaruan langsung terkait status pendaftaran dan penilaian.
* **Pengaturan Akun**: Mengelola profil pribadi dan kata sandi.

### 3. Dashboard Pengurus (Verifikator & Penilai)
* **Verifikasi Pendaftaran**: Memeriksa berkas calon anggota serta melakukan persetujuan (*Approve*) atau penolakan (*Reject*) pendaftaran.
* **Penilaian Seleksi**: Menginput nilai seleksi peserta berdasarkan kriteria yang telah ditentukan.
* **Perhitungan Nilai Akhir**: Sistem secara otomatis menghitung nilai akhir calon anggota menggunakan metode bobot persentase dari kriteria yang tersedia.
* **Pengumuman**: Mengelola dan menyiarkan pengumuman resmi ke dashboard calon anggota.

### 4. Dashboard Administrator (Super User)
* **Manajemen Pengguna**: Mengelola seluruh akun di dalam sistem (Admin, Pengurus, Calon Anggota).
* **Manajemen Konten Publik**: Mengelola berita (CRUD Berita), jadwal kegiatan (CRUD Jadwal), dan dokumentasi galeri (CRUD Galeri/Album).
* **Manajemen Kriteria**: Menentukan kriteria seleksi beserta bobot persentasenya secara dinamis.
* **Manajemen Profil**: Mengubah konten sejarah dan visi-misi secara dinamis dari dashboard.
* **Laporan Pendaftaran**: Menyusun dan melihat ringkasan laporan pendaftar yang masuk ke sistem.

---

## Tech Stack & Dependensi

* **Backend Framework**: [Laravel 12.x](https://laravel.com) (PHP >= 8.2)
* **Frontend Build Tool**: [Vite](https://vite.dev)
* **CSS Framework**: [Tailwind CSS v4.0](https://tailwindcss.com) (menggunakan `@tailwindcss/vite` compiler baru)
* **Database**: SQLite (default untuk pengembangan lokal) / Support MySQL
* **Tools Lain**: Concurrently (untuk menjalankan server development secara paralel)

---

## Panduan Instalasi & Setup

Ikuti langkah-langkah di bawah ini untuk menjalankan project di lingkungan lokal Anda:

### 1. Clone Repositori
```bash
git clone <url-repository>
cd paskibra_website
```

### 2. Instalasi Otomatis (Rekomendasi)
Project ini menyediakan skrip otomasi menggunakan Composer untuk mempermudah proses setup awal (instalasi library PHP & Node.js, penyalinan file `.env`, pembuatan application key, migrasi database, dan build frontend):

```bash
composer run setup
```

*Jika Anda ingin melakukan setup secara manual, ikuti langkah berikut:*
```bash
# Install package composer
composer install

# Salin file environment
copy .env.example .env

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate --force

# Install package npm & build asset
npm install
npm run build
```

### 3. Konfigurasi Database `.env`
Secara default, project ini dikonfigurasi menggunakan **SQLite** agar langsung siap digunakan tanpa setup database server tambahan. Jika Anda ingin beralih ke **MySQL**, silakan sesuaikan file `.env` Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paskibra_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Menjalankan Seeders (Akun Demo)
Untuk mengisi database dengan kriteria awal dan akun-akun demo (Admin, Pengurus, dan Calon Anggota), jalankan perintah:
```bash
php artisan db:seed
```

---

## Cara Menjalankan Project

Untuk menjalankan server Laravel, queue runner, logs viewer (Laravel Pail), dan Vite dev server secara bersamaan dengan satu perintah, jalankan:

```bash
composer run dev
```

Skrip di atas menggunakan `concurrently` untuk menghemat terminal Anda dan menjalankan proses berikut secara paralel:
* **Laravel Server** di `http://127.0.0.1:8000`
* **Vite Hot Reload** untuk asset frontend
* **Queue Listener** untuk memproses antrean tugas di latar belakang
* **Laravel Pail** untuk streaming log error secara interaktif

---

## Akun Demo Pengujian

Setelah menjalankan `db:seed`, Anda dapat masuk menggunakan akun demo berikut:

| Role | NISN / Username | Password | Deskripsi Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `199305052023211016` | `admin123` | Akses penuh sistem, kriteria, berita, & manajemen user. |
| **Pengurus** | `0987654321` | `password123` | Verifikasi pendaftaran, input nilai seleksi, & pengumuman. |
| **Calon Anggota** | `1234567890` | `password123` | Mengisi formulir, cek hasil seleksi, & lihat notifikasi. |

---

## Perhitungan Kelulusan Seleksi

Sistem ini melakukan seleksi berdasarkan **Kriteria Berbobot** yang diinputkan oleh Administrator. 

* **Formulasi Perhitungan**:
  $$\text{Nilai Akhir} = \sum_{i=1}^{n} \left( \text{Nilai Kriteria}_i \times \frac{\text{Bobot Kriteria}_i}{100} \right)$$
* Pengurus dapat melihat daftar peringkat peserta berdasarkan Nilai Akhir untuk mempermudah proses seleksi penerimaan anggota baru Paskibra secara objektif.

---
