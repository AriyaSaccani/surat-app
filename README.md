# Panduan Setup Proyek

## Prasyarat
1. **Laragon**: Pastikan Laragon sudah terinstal di sistem Anda.
2. **Composer**: Pastikan Composer sudah terinstal dan dikonfigurasi dengan benar.

---

## Langkah-Langkah Instalasi

### 1. Jalankan Laragon
   - Buka **Laragon** dan pastikan server berjalan.
   - Periksa bahwa layanan **Apache/Nginx** dan **MySQL** aktif.

---

### 2. Install atau Update Dependency
   - Buka terminal dan arahkan ke direktori proyek:
     ```bash
     cd /path/ke/proyek/anda
     ```
   - Jalankan perintah berikut untuk menginstal dependency:
     ```bash
     composer install
     ```
   - Jika membutuhkan pembaruan, jalankan:
     ```bash
     composer update
     ```

---

### 3. Generate Key Aplikasi
   - Gunakan perintah berikut untuk membuat key aplikasi:
     ```bash
     php artisan key:generate
     ```

---

### 4. Atur File Environment
   - Salin file `.env.example` menjadi `.env`:
     ```bash
     cp .env.example .env
     ```
   - Buka file `.env` dan atur konfigurasi database Anda:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nama_database_anda
     DB_USERNAME=user_database_anda
     DB_PASSWORD=password_database_anda
     ```

---

### 5. Seed Database
   - Isi database dengan data awal menggunakan perintah:
     ```bash
     php artisan db:seed
     ```

---

### 6. Jalankan Migrasi
   - Jalankan perintah berikut untuk membuat tabel-tabel yang diperlukan:
     ```bash
     php artisan migrate
     ```

---

## Catatan Tambahan
- Pastikan file `.env` Anda juga dikonfigurasi dengan benar untuk layanan lain (misalnya, mail, caching) sesuai kebutuhan.
- Jika mengalami masalah, periksa **log error** yang berada di direktori `storage/logs`.

**Selamat bekerja!**
**dari proggramer pemalas**
