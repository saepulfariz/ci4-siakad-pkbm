# SIAKAD PKBM (Sistem Informasi Akademik)

SIAKAD PKBM adalah Sistem Informasi Akademik yang dibangun menggunakan **CodeIgniter 4**. Aplikasi ini dirancang khusus untuk Pusat Kegiatan Belajar Masyarakat (PKBM) guna mengelola data akademik, memfasilitasi _e-learning_ (pembelajaran jarak jauh), serta memantau kegiatan belajar mengajar antara Siswa, Guru, dan Admin.

## 🚀 Fitur Utama

- **Multi-Role Authentication**: Mendukung pembagian hak akses untuk _Superadmin_, _Guru_ (Teacher), dan _Siswa_ (Student) yang aman menggunakan _library_ CodeIgniter Shield.
- **Manajemen Data Akademik**: Pengelolaan komprehensif mulai dari Tahun Ajaran, Semester, Data Kelas, Mata Pelajaran, hingga Data Pendidikan.
- **E-Learning & Penugasan**:
  - Guru dapat mengunggah Materi Pelajaran dan membuat Penugasan (Assignments).
  - Siswa dapat mengumpulkan/mengirim tugas secara online melalui sistem (Assignment Submissions).
- **Monitoring Kehadiran**: Pengecekan dan pelaporan riwayat kehadiran dan partisipasi siswa.
- **Pengumuman & Notifikasi**: Sistem _announcement_ dan notifikasi _real-time_ kepada _user_ terkait.
- **Support Multi-Database**: Kode dirancang untuk bisa berjalan di MySQL/MariaDB maupun SQLite3 secara mulus tanpa error.

## 🛠️ Persyaratan Sistem (Server Requirements)

- **PHP 8.1** atau lebih baru.
- Ekstensi PHP: `intl`, `mbstring`, `json`, `mysqlnd` (jika menggunakan MySQL), `libcurl`, `sqlite3` (jika menggunakan SQLite).
- **Composer** (untuk instalasi dependensi).

## 📦 Panduan Instalasi & Konfigurasi

1. **Clone/Download Project**
   Pastikan _source code_ sudah berada di folder server Anda (contoh: di `htdocs` XAMPP, `www` Laragon, atau Herd).

2. **Install Dependencies**
   Buka terminal di root proyek, lalu jalankan Composer:

   ```bash
   composer install
   ```

3. **Konfigurasi Lingkungan (.env)**
   Salin file `env` bawaan CI4 menjadi `.env` lalu sesuaikan konfigurasinya.

   ```bash
   cp env .env
   ```

   Buka file `.env` dan atur Base URL Anda:

   ```env
   app.baseURL = 'http://localhost:8080/'
   ```

   Atur koneksi database Anda, misalnya untuk **MySQL**:

   ```env
   database.default.hostname = localhost
   database.default.database = ci4_siakad_pkbm
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```

   Atau jika menggunakan **SQLite3**:

   ```env
   database.default.database = database.db
   database.default.DBDriver = SQLite3
   ```

4. **Jalankan Migrasi dan Seeder (Otomatis Buat Tabel)**
   Sistem ini menggunakan _migration_ untuk membangun struktur tabel secara otomatis dan _seeder_ untuk mengisi data awal (dummy).

   ```bash
   php spark migrate:refresh --all
   php spark db:seed All
   ```

5. **Buat Symlink Storage**
   Agar file hasil _upload_ (seperti foto profil, lampiran materi, dan tugas) bisa diakses secara publik, buatlah _symlink_ dari folder `writable/uploads` ke `public/uploads`.

   _Untuk Windows (Jalankan CMD sebagai Administrator):_

   ```cmd
   cd public
   mklink /D uploads ..\writable\uploads
   ```

   _Untuk Linux / cPanel (Terminal):_

   ```bash
   cd public
   ln -s ../writable/uploads uploads
   ```

6. **Jalankan Aplikasi (Local Development)**
   Gunakan server bawaan CodeIgniter untuk pengembangan:
   ```bash
   php spark serve
   ```
   SIAKAD PKBM sekarang dapat diakses di URL: `http://localhost:8080/`.

## 🔑 Login Default (Akun Dummy)

Data _dummy_ telah terbuat saat Anda menjalankan proses seeder. Anda dapat masuk/login melalui URL `http://localhost:8080/login` dengan menggunakan akun berikut:

**1. Superadmin**

- Email: `super@admin.com`
- Password: `password`

**2. Guru (Teacher)**

- Email: `teacher@mail.com`
- Password: `123`

**3. Siswa (Student)**

- Email: `student@mail.com`
- Password: `123`

---

_Aplikasi ini dibangun menggunakan [CodeIgniter 4](https://codeigniter.com)._
