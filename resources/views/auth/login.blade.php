@extends('layouts.app')

@section('title', 'Login - Sistem Reservasi Ruangan')

@section('content')
<!-- Background Pattern -->
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-red-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
    
    <div class="relative min-h-screen flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-5xl">
            <!-- Login Card - Wide Layout -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-red-100">
                <div class="grid md:grid-cols-2">
                    <!-- Left Side - Welcome Section -->
                    <div class="bg-gradient-to-br from-red-600 via-red-700 to-red-800 p-12 text-white relative overflow-hidden flex flex-col justify-center">
                        <!-- Decorative circles -->
                        <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-16 -translate-y-16"></div>
                        <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/10 rounded-full translate-x-20 translate-y-20"></div>
                        <div class="absolute top-1/2 right-0 w-24 h-24 bg-white/5 rounded-full translate-x-12"></div>
                        
                        <div class="relative z-10">
                            <div class="bg-white/20 w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-lg">
                                <i class="fas fa-door-open text-white text-3xl"></i>
                            </div>
                            <h1 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h1>
                            <p class="text-red-100 text-lg mb-8">Masuk untuk mengakses sistem reservasi ruangan dan kelola jadwal Anda dengan mudah.</p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Reservasi ruangan kapan saja</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Kelola jadwal dengan mudah</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Notifikasi real-time</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form Section -->
                    <div class="p-12 bg-white flex flex-col justify-center">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Masuk</h2>
                            <p class="text-gray-600">Masukkan kredensial Anda untuk melanjutkan</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-5">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    required 
                                    autofocus
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('email') border-red-500 @enderror"
                                    placeholder="nama@email.com"
                                >
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-5">
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                                </label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('password') border-red-500 @enderror"
                                        placeholder="••••••••"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="togglePassword('password')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    >
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between mb-6">
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="remember" 
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-800 hover:underline">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-6 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl mb-5"
                            >
                                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                            </button>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-gray-600 text-sm">
                                    Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800 font-semibold hover:underline">
                                        Daftar Sekarang
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center text-red-600 hover:text-red-800 transition-colors duration-200 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.animation-delay-2000 {
    animation-delay: 2s;
}
</style>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection