<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminUserController;


// ============================================
// PUBLIC ROUTES (Tanpa Login)
// ============================================

// Halaman Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Rooms (Public - lihat ruangan tersedia)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// ============================================
// USER ROUTES (Perlu Login sebagai User)
// ============================================

Route::middleware(['auth', 'prevent.back'])->group(function () {
    // Dashboard User
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    
    // Reservasi CRUD untuk User
    Route::get('/reservasi/create', [ReservationController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
    Route::delete('/reservasi/{id}', [ReservationController::class, 'destroy'])->name('reservasi.destroy');
});

// Auth routes dari Breeze/Jetstream
require __DIR__.'/auth.php';

// ============================================
// ADMIN AUTH ROUTES (Tanpa middleware)
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// ============================================
// ADMIN PROTECTED ROUTES (Dengan middleware)
// ============================================
Route::prefix('admin')->name('admin.')->middleware(['admin', 'prevent.back'])->group(function () {
    
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Rooms CRUD
    Route::resource('rooms', AdminRoomController::class);
    
    // Reservations CRUD
    Route::resource('reservations', AdminReservationController::class);
    
    // Users CRUD
    Route::resource('users', AdminUserController::class);
    

});
