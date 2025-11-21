@extends('layouts.app')

@section('title', 'Dashboard | RuangRapat')

@section('content')

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-red-500 via-red-600 to-red-800 rounded-3xl p-14 mb-14 shadow-xl">
    <!-- Decorative blob -->
    <div class="absolute top-0 right-0 opacity-20 blur-3xl w-80 h-80 bg-white rounded-full"></div>

    <div class="relative z-10 max-w-3xl">
        <h1 class="text-5xl font-extrabold text-white leading-tight drop-shadow-md">
            <span class="block">Pesan Ruang Meeting</span>
            <span class="text-red-200">Lebih Cepat & Terorganisir</span>
        </h1>

        <p class="text-lg text-red-100 mt-4">
            Kelola reservasi ruang rapat kapan saja, tanpa ribet.  
            Sistem cerdas mencegah jadwal bentrok dan mempermudah koordinasi antar divisi.
        </p>

        <div class="flex flex-wrap mt-8 gap-4">
            @auth
                <a href="{{ route('reservasi.create') }}" 
                   class="bg-white text-red-600 px-6 py-3 shadow-md rounded-xl hover:-translate-y-1 transform transition font-semibold flex items-center gap-2">
                    <i class="fas fa-calendar-plus"></i> Buat Reservasi
                </a>
            @else
                <a href="{{ route('register') }}" 
                   class="bg-white text-red-600 px-6 py-3 shadow-md rounded-xl hover:-translate-y-1 transform transition font-semibold flex items-center gap-2">
                    <i class="fas fa-user-plus"></i> Daftar Akun
                </a>
            @endauth

            <a href="{{ route('rooms.index') }}" 
               class="border-2 border-white text-white px-6 py-3 rounded-xl hover:bg-white hover:text-red-600 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-door-open"></i> Lihat Ruangan
            </a>
        </div>
    </div>
</section>


<!-- Feature Section -->
<section class="mb-14">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Kenapa Memakai RuangRapat?</h2>

    <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Card 1 -->
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition text-center">
            <div class="bg-red-100 text-red-600 h-16 w-16 mx-auto flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-bolt text-2xl"></i>
            </div>
            <h3 class="font-semibold text-lg text-gray-800">Proses Super Cepat</h3>
            <p class="text-gray-600 mt-2">UI yang simpel bikin kamu bisa booking ruangan dalam hitungan detik.</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition text-center">
            <div class="bg-green-100 text-green-600 h-16 w-16 mx-auto flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-shield-alt text-2xl"></i>
            </div>
            <h3 class="font-semibold text-lg text-gray-800">Anti Double Booking</h3>
            <p class="text-gray-600 mt-2">Sistem otomatis mendeteksi jadwal bentrok sebelum kamu submit.</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition text-center">
            <div class="bg-amber-100 text-amber-600 h-16 w-16 mx-auto flex items-center justify-center rounded-full mb-4">
                <i class="fas fa-history text-2xl"></i>
            </div>
            <h3 class="font-semibold text-lg text-gray-800">Riwayat Tersimpan</h3>
            <p class="text-gray-600 mt-2">Semua reservasi terdahulu bisa kamu lihat kapan aja di dashboard.</p>
        </div>
    </div>
</section>


<!-- How It Works Section -->
<section class="mb-14">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Cara Kerja</h2>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="relative">
            <div class="bg-white p-6 rounded-xl shadow border-t-4 border-red-500">
                <div class="absolute -top-4 left-6 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">1</div>
                <h3 class="text-lg font-semibold mt-2 mb-2 text-gray-800">Pilih Ruangan</h3>
                <p class="text-gray-600 text-sm">Lihat daftar ruangan yang tersedia beserta kapasitas dan fasilitasnya.</p>
            </div>
        </div>

        <div class="relative">
            <div class="bg-white p-6 rounded-xl shadow border-t-4 border-red-400">
                <div class="absolute -top-4 left-6 bg-red-400 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">2</div>
                <h3 class="text-lg font-semibold mt-2 mb-2 text-gray-800">Tentukan Waktu</h3>
                <p class="text-gray-600 text-sm">Pilih tanggal dan jam sesuai kebutuhan pada jam kerja.</p>
            </div>
        </div>

        <div class="relative">
            <div class="bg-white p-6 rounded-xl shadow border-t-4 border-red-300">
                <div class="absolute -top-4 left-6 bg-red-300 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">3</div>
                <h3 class="text-lg font-semibold mt-2 mb-2 text-gray-800">Konfirmasi</h3>
                <p class="text-gray-600 text-sm">Submit reservasi dan ruangan langsung terbooking untuk Anda.</p>
            </div>
        </div>
    </div>
</section>


<!-- Informasi Jam Operasional -->
<div class="bg-amber-50 p-6 border-l-8 border-amber-500 rounded-xl flex gap-4 items-start mb-14">
    <div><i class="fas fa-clock text-amber-600 text-3xl"></i></div>
    <div>
        <h3 class="font-bold text-amber-700 text-lg">Jam Operasional Sistem</h3>
        <p class="text-amber-700 mt-1">
            Reservasi aktif pada pukul <strong>08:00 - 17:00</strong> (Senin - Jumat).
        </p>
    </div>
</div>


<!-- CTA Section -->
<section class="bg-gray-800 rounded-2xl p-10 text-center">
    <h2 class="text-2xl font-bold text-white mb-3">Siap Untuk Memesan Ruangan?</h2>
    <p class="text-gray-400 mb-8">Mulai reservasi pertama Anda sekarang juga</p>
    <div class="flex justify-center flex-wrap gap-4">
        @auth
            <a href="{{ route('reservasi.create') }}" class="bg-red-500 text-white px-8 py-4 rounded-xl font-semibold hover:bg-red-600 transition flex items-center gap-2">
                <i class="fas fa-calendar-plus"></i> Buat Reservasi
            </a>
            <a href="{{ route('dashboard') }}" class="bg-gray-700 text-white px-8 py-4 rounded-xl font-semibold hover:bg-gray-600 transition flex items-center gap-2">
                <i class="fas fa-history"></i> Lihat Riwayat
            </a>
        @else
            <a href="{{ route('register') }}" class="bg-red-500 text-white px-8 py-4 rounded-xl font-semibold hover:bg-red-600 transition flex items-center gap-2">
                <i class="fas fa-user-plus"></i> Daftar Gratis
            </a>
            <a href="{{ route('login') }}" class="bg-gray-700 text-white px-8 py-4 rounded-xl font-semibold hover:bg-gray-600 transition flex items-center gap-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        @endauth
    </div>
</section>

@endsection