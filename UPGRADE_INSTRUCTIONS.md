# Instruksi Upgrade PHP dan Perbaikan Error

## Masalah Utama
- PHP 8.0.30 tidak kompatibel dengan Laravel 12 yang membutuhkan PHP 8.2+
- Keyword `readonly` tidak didukung di PHP 8.0

## Solusi 1: Upgrade PHP (Recommended)
1. Buka Laragon
2. Klik kanan pada Laragon tray icon
3. Pilih "PHP" > "Version" > Pilih PHP 8.2 atau 8.3
4. Restart Laragon
5. Jalankan: `php artisan serve`

## Solusi 2: Downgrade Laravel (Temporary)
Jika tidak bisa upgrade PHP, jalankan:
```bash
composer require laravel/framework:^11.0 --with-all-dependencies
composer update
```

## Perbaikan yang Sudah Dilakukan
✅ Menambahkan `is_admin => false` di RegisteredUserController
✅ Menambahkan redirect berdasarkan role di AuthenticatedSessionController  
✅ Memperbaiki struktur folder Admin controllers
✅ Memindahkan AdminMiddleware ke lokasi yang benar
✅ Menambahkan platform-check: false di composer.json

## Test Setelah Upgrade PHP
1. `php artisan migrate:fresh --seed`
2. `php artisan serve`
3. Buka http://localhost:8000
4. Test registrasi user baru
5. Test login admin (admin@admin.com / password)