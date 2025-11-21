# 🔐 Cara Akses Admin Panel

## 📍 URL Admin Login
```
http://localhost:8000/admin/login
```

## 🚀 Cara Akses Admin Panel

### Metode 1: Link di Navbar
1. Buka website utama: `http://localhost:8000`
2. Klik link **"Admin"** di navbar (pojok kanan atas)
3. Akan diarahkan ke halaman login admin

### Metode 2: URL Langsung
1. Ketik langsung: `http://localhost:8000/admin/login`
2. Masukkan kredensial admin

## 🔑 Kredensial Admin
```
📧 Email: admin@admin.com
🔑 Password: password
```

## 🛠️ Troubleshooting

### ❌ "Akses Ditolak" setelah login?
**Penyebab:** User belum memiliki status admin

**Solusi:** Jalankan script untuk membuat admin:
```bash
php create_admin_simple.php
```

### ❌ "Target class AdminAuthController does not exist"?
**Penyebab:** Controller belum ter-load

**Solusi:**
```bash
composer dump-autoload --no-scripts
```

### ❌ Tidak bisa akses halaman admin setelah login?
**Penyebab:** Middleware AdminMiddleware salah konfigurasi

**Solusi:** Sudah diperbaiki, pastikan field `is_admin = 1` di database

## 📋 Fitur Admin Panel
Setelah login admin berhasil, Anda dapat mengakses:

- 📊 **Dashboard** - Statistik dan overview
- 🏢 **Kelola Ruangan** - CRUD ruangan meeting
- 👥 **Kelola Users** - CRUD users dengan search
- 📅 **Kelola Reservasi** - CRUD reservasi dengan filter

## 🔄 Reset Admin (Jika Diperlukan)
Jika ada masalah dengan admin user, jalankan:
```bash
php create_admin_simple.php
```

Script ini akan:
- ✅ Membuat admin baru jika belum ada
- ✅ Update user existing menjadi admin
- ✅ Tidak merusak data yang sudah ada