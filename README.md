# 🔐 Laravel Authentication & Breeze — auth-demo

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Proyek tugas mata kuliah **Pemrograman Web** dengan topik **Laravel Authentication & Laravel Breeze**.
Aplikasi ini mengimplementasikan sistem autentikasi lengkap dengan fitur tambahan berupa manajemen profil dan sistem role admin.

---

## 👤 Identitas

| Keterangan | Detail |
|---|---|
| **Nama** | Rafi |
| **Mata Kuliah** | Pemrograman Web |
| **Topik** | Laravel Authentication & Breeze |
| **Framework** | Laravel 11.x |

---

## 📋 Daftar Isi

- [Fitur Aplikasi](#-fitur-aplikasi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Cara Instalasi](#-cara-instalasi)
- [Struktur Tugas](#-struktur-tugas)
- [Alur Penggunaan](#-alur-penggunaan)
- [Struktur Folder](#-struktur-folder)

---

## ✨ Fitur Aplikasi

| Fitur | Keterangan |
|---|---|
| Register | Pendaftaran akun baru dengan validasi lengkap termasuk No. HP |
| Login | Autentikasi dengan email dan password |
| Logout | Keluar dari sesi dengan aman |
| Dashboard | Menampilkan data user yang sedang login |
| Edit Profil | Mengubah nama, email, dan No. HP |
| Ganti Password | Mengubah password user |
| Halaman Admin | Menampilkan daftar semua user (khusus role admin) |
| Middleware Admin | Proteksi route `/admin` hanya untuk role admin |

---

## ✅ Persyaratan Sistem

| Kebutuhan | Versi |
|---|---|
| PHP | 8.2+ |
| Composer | 2.x |
| Node.js & npm | 18.x+ |
| MySQL / MariaDB | 5.7+ |
| Laravel | 11.x |
| XAMPP | Versi terbaru |

---

## 🚀 Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/auth-demo.git
cd auth-demo
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Frontend

```bash
npm install
npm run build
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buat database baru di phpMyAdmin bernama `auth_demo`, lalu buka file `.env` dan sesuaikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=auth_demo
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migrasi

```bash
php artisan migrate
```

### 8. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di **http://localhost:8000**

---

## 📝 Struktur Tugas

### Tugas 1 — Tambah Field No. HP (30 Poin)

Menambahkan kolom `no_hp` pada tabel `users` dan form registrasi.

**File yang diubah:**
- `database/migrations/0001_01_01_000000_create_users_table.php` — tambah kolom `no_hp`
- `app/Models/User.php` — tambah `no_hp` ke `$fillable`
- `app/Http/Controllers/Auth/RegisteredUserController.php` — tambah validasi `no_hp`
- `resources/views/auth/register.blade.php` — tambah input field `no_hp`
- `resources/views/dashboard.blade.php` — tampilkan `no_hp` di dashboard

**Validasi No. HP:**
```php
'no_hp' => ['required', 'regex:/^[0-9]+$/', 'min:10', 'max:15']
```

---

### Tugas 2 — Edit Profil dengan No. HP (30 Poin)

Menambahkan field `no_hp` pada halaman edit profil.

**File yang diubah:**
- `app/Http/Requests/ProfileUpdateRequest.php` — tambah validasi `no_hp`
- `resources/views/profile/partials/update-profile-information-form.blade.php` — tambah input `no_hp`

---

### Tugas 3 — Halaman Admin dengan Role (40 Poin)

Membuat sistem role dan halaman admin yang hanya bisa diakses oleh user dengan role `admin`.

**File yang dibuat/diubah:**
- `database/migrations/0001_01_01_000000_create_users_table.php` — tambah kolom `role`
- `app/Http/Middleware/AdminMiddleware.php` — middleware cek role admin
- `app/Http/Controllers/AdminController.php` — controller halaman admin
- `resources/views/admin/index.blade.php` — view daftar semua user
- `routes/web.php` — tambah route `/admin`
- `bootstrap/app.php` — daftarkan alias middleware `admin`

**Set Role Admin via Tinker:**
```bash
php artisan tinker
User::where('name', 'Rafi')->update(['role' => 'admin']);
```

---

## 🖥️ Alur Penggunaan

### Sebagai User Biasa

```
Buka /register → Isi form (nama, email, no. HP, password)
        │
        ▼
Login berhasil → Redirect ke /dashboard
        │
        ▼
Lihat data diri (nama, email, no. HP, role)
        │
        ▼
Buka /profile → Edit nama, email, no. HP → Save
        │
        ▼
Logout → Kembali ke halaman utama
```

### Sebagai Admin

```
Login dengan akun role admin
        │
        ▼
Akses /admin
        │
        ▼
Lihat tabel daftar semua user
```

### Akses Ditolak

```
User biasa akses /admin
        │
        ▼
AdminMiddleware cek role
        │
        ▼
role !== 'admin' → Error 403 Forbidden
```

---

## 📁 Struktur Folder

```
auth-demo/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   └── RegisteredUserController.php      ← Tugas 1
│   │   │   ├── AdminController.php                   ← Tugas 3
│   │   │   └── ProfileController.php                 ← Tugas 2
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php                   ← Tugas 3
│   │   └── Requests/
│   │       └── ProfileUpdateRequest.php              ← Tugas 2
│   └── Models/
│       └── User.php                                  ← Tugas 1 & 3
├── bootstrap/
│   └── app.php                                       ← Tugas 3
├── database/
│   └── migrations/
│       └── 0001_01_01_000000_create_users_table.php  ← Tugas 1 & 3
├── resources/
│   └── views/
│       ├── admin/
│       │   └── index.blade.php                       ← Tugas 3
│       ├── auth/
│       │   └── register.blade.php                    ← Tugas 1
│       ├── profile/
│       │   └── partials/
│       │       └── update-profile-information-form.blade.php ← Tugas 2
│       └── dashboard.blade.php                       ← Tugas 1
├── routes/
│   ├── web.php                                       ← Tugas 3
│   └── auth.php
└── .env.example
```

---

## 🔒 Keamanan yang Diterapkan

- ✅ Password di-hash otomatis dengan **bcrypt**
- ✅ **CSRF Protection** aktif di semua form
- ✅ **Session regeneration** setelah login
- ✅ **Rate limiting** pada form login (mencegah brute force)
- ✅ **Middleware** proteksi route berdasarkan role
- ✅ **Validasi input** di semua form

---

## 📚 Referensi

- [Laravel Authentication Docs](https://laravel.com/docs/authentication)
- [Laravel Breeze Docs](https://laravel.com/docs/starter-kits#laravel-breeze)
- [Laravel Middleware Docs](https://laravel.com/docs/middleware)
- [Laravel Validation Rules](https://laravel.com/docs/validation#available-validation-rules)

---

> 📌 Dibuat untuk keperluan tugas Mata Kuliah Pemrograman Web — Laravel Authentication & Breeze
