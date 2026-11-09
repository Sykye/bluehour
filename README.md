# BlueHour

BlueHour adalah aplikasi web berbasis Laravel untuk **pemesanan jasa jahit online**. Pelanggan dapat membuat pesanan jahit custom, mengirim ukuran badan serta gambar referensi/desain, lalu mengunggah bukti pembayaran. Admin mengelola layanan, memberikan estimasi harga, memproses pesanan, dan memverifikasi pembayaran.

## Fitur

### Halaman publik
- Landing page dengan informasi layanan, keunggulan, testimoni, dan FAQ.
- Daftar layanan jahit yang aktif.
- Registrasi dan login pengguna.

### Pelanggan
- Dashboard dengan ringkasan pesanan.
- Membuat pesanan baru: pilih layanan, isi catatan, ukuran badan, sumber bahan, serta upload gambar referensi dan desain.
- Melihat daftar dan detail pesanan.
- Mengunggah bukti pembayaran.
- Membatalkan pesanan selama status masih `menunggu_estimasi` atau `menunggu_pembayaran`.
- Mengubah profil dan password.

### Admin
- Dashboard statistik: jumlah pelanggan, layanan, pesanan, pendapatan, estimasi tertunda, dan pembayaran tertunda.
- CRUD layanan (tambah, lihat, ubah, hapus) beserta gambar layanan.
- Melihat dan mencari seluruh pesanan.
- Memberikan estimasi harga dan mengubah status pesanan.
- Memverifikasi atau menolak bukti pembayaran.
- Melihat log aktivitas pengguna.

## Alur pesanan

1. Pelanggan mendaftar atau login.
2. Pelanggan membuat pesanan dan mengisi ukuran badan serta detail jahitan.
3. Admin melihat pesanan, mengisi estimasi harga, lalu mengubah status menjadi `menunggu_pembayaran`.
4. Pelanggan mengunggah bukti pembayaran.
5. Admin memverifikasi pembayaran. Jika disetujui, status pesanan menjadi `diproses`.
6. Admin memperbarui status sesuai progres: `penjahitan` → `finishing` → `selesai` → `dikirim`.

### Status pesanan

| Status | Keterangan |
| --- | --- |
| `menunggu_estimasi` | Pesanan baru, menunggu estimasi harga dari admin |
| `menunggu_pembayaran` | Estimasi sudah diberikan, menunggu pembayaran pelanggan |
| `diproses` | Pembayaran terverifikasi, pesanan mulai diproses |
| `penjahitan` | Pesanan sedang dijahit |
| `finishing` | Tahap penyelesaian akhir |
| `selesai` | Pesanan selesai |
| `dikirim` | Pesanan dikirim ke pelanggan |
| `dibatalkan` | Pesanan dibatalkan |

### Status pembayaran

| Status | Keterangan |
| --- | --- |
| `belum_bayar` | Belum ada bukti pembayaran |
| `menunggu_verifikasi` | Bukti sudah diunggah, menunggu verifikasi admin |
| `terverifikasi` | Pembayaran disetujui admin |
| `ditolak` | Bukti pembayaran ditolak admin |

## Teknologi

- **Laravel 13** (PHP 8.3+)
- **MySQL 8**
- **Blade**, **Tailwind CSS 3**, **Alpine.js 3**
- **Vite 8**
- **Laravel Breeze** untuk autentikasi

## Kebutuhan sistem

- PHP 8.3 atau lebih baru dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, dan `zip`.
- Composer 2.
- Node.js 20.19+ atau 22.12+ dan npm.
- MySQL 8.

## Instalasi

1. Clone repository:

   ```powershell
   git clone https://github.com/Sykye/bluehour.git
   cd bluehour
   ```

2. Install dependency PHP:

   ```powershell
   composer install
   ```

3. Buat file `.env` dari template:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

4. Buat database MySQL:

   ```sql
   CREATE DATABASE bluehour_db
   CHARACTER SET utf8mb4
   COLLATE utf8mb4_unicode_ci;
   ```

5. Sesuaikan konfigurasi database di `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bluehour_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Jalankan migrasi dan seeder:

   ```powershell
   php artisan migrate --seed
   ```

7. Buat symbolic link storage untuk gambar upload:

   ```powershell
   php artisan storage:link
   ```

8. Install dependency frontend dan build aset:

   ```powershell
   npm install
   npm run build
   ```

9. Jalankan server:

   ```powershell
   php artisan serve
   ```

10. Buka **http://127.0.0.1:8000**.

## Akun default

Seeder membuat akun admin berikut:

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@bluehour.com` | `Admin@12345` |

Pelanggan baru dapat mendaftar melalui halaman `/register`. Setelah login pertama, disarankan mengganti password admin.

## Struktur proyek

| Path | Keterangan |
| --- | --- |
| `app/Http/Controllers/Admin` | Controller untuk admin (layanan, pesanan, log aktivitas) |
| `app/Http/Controllers/User` | Controller untuk pelanggan (pesanan dan pembayaran) |
| `app/Http/Controllers/Auth` | Autentikasi dari Laravel Breeze |
| `app/Models` | Model `User`, `Service`, `Order`, dan `ActivityLog` |
| `app/Policies` | Aturan akses `OrderPolicy` dan `ServicePolicy` |
| `app/Http/Middleware` | `RoleMiddleware` dan `SecurityHeadersMiddleware` |
| `app/Http/Requests` | Validasi form pesanan, layanan, pembayaran, dan profil |
| `database/migrations` | Skema tabel aplikasi |
| `database/seeders` | Seeder admin dan layanan contoh |
| `resources/views` | Tampilan Blade untuk publik, admin, dan pelanggan |
| `routes/web.php` | Routing utama aplikasi |

## Keamanan

- Middleware `role` membatasi akses halaman admin dan pelanggan.
- Policy `OrderPolicy` dan `ServicePolicy` mengatur hak akses per pengguna.
- CSRF protection aktif pada seluruh form.
- Validasi upload file membatasi ekstensi dan MIME type gambar.
- Nama file upload dibuat acak (UUID) untuk menghindari path traversal.
- `SecurityHeadersMiddleware` menambahkan header keamanan (CSP, X-Frame-Options, X-Content-Type-Options, dan lainnya).
- Aktivitas penting dicatat ke tabel `activity_logs`.

## Catatan pengembangan

- File `.env` tidak disertakan di repository karena berisi kredensial. Selalu buat `.env` baru dari `.env.example`.
- Folder `public/build`, `vendor`, dan `node_modules` tidak disertakan. Jalankan `composer install`, `npm install`, dan `npm run build` setelah clone.
- Untuk melihat tampilan final, gunakan `npm run build`. Mode `npm run dev`/`composer run dev` menjalankan Vite di port 5173; middleware CSP saat ini hanya mengizinkan aset dari origin aplikasi, jadi aset Vite dapat diblokir browser. Jika ingin memakai hot reload, sesuaikan CSP agar mengizinkan `http://localhost:5173` dan `http://[::1]:5173`.
- Email menggunakan `MAIL_MAILER=log`. Link reset password akan tertulis di `storage/logs/laravel.log`, bukan dikirim ke email sungguhan.
