@extends('layouts.app')

@section('title', 'Register - Sistem Reservasi Ruangan')

@section('content')
<!-- Background Pattern -->
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-red-300 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse animation-delay-2000"></div>
    
    <div class="relative min-h-screen flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-6xl">
            <!-- Register Card - Wide Layout -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-red-100">
                <div class="grid md:grid-cols-2">
                    <!-- Left Side - Welcome Section -->
                    <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 p-12 text-white relative overflow-hidden flex flex-col justify-center">
                        <!-- Decorative circles -->
                        <div class="absolute top-0 left-0 w-40 h-40 bg-white/10 rounded-full -translate-x-20 -translate-y-20"></div>
                        <div class="absolute bottom-0 right-0 w-48 h-48 bg-white/10 rounded-full translate-x-24 translate-y-24"></div>
                        <div class="absolute top-1/3 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-16"></div>
                        <div class="absolute bottom-1/4 left-0 w-24 h-24 bg-white/5 rounded-full -translate-x-12"></div>
                        
                        <div class="relative z-10">
                            <div class="bg-white/20 w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-lg">
                                <i class="fas fa-user-plus text-white text-3xl"></i>
                            </div>
                            <h1 class="text-4xl font-bold mb-4">Bergabung Dengan Kami!</h1>
                            <p class="text-red-100 text-lg mb-8">Buat akun baru dan nikmati kemudahan dalam melakukan reservasi ruangan untuk kebutuhan Anda.</p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Pendaftaran cepat & mudah</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Akses ke semua ruangan</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Dashboard personal</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-2 rounded-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <span>Gratis selamanya</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form Section -->
                    <div class="p-12 bg-white flex flex-col justify-center">
                        <div class="mb-6">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun</h2>
                            <p class="text-gray-600">Isi formulir di bawah untuk mendaftar</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="grid grid-cols-1 gap-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-user mr-2 text-gray-400"></i>Nama Lengkap
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        value="{{ old('name') }}"
                                        required 
                                        autofocus
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('name') border-red-500 @enderror"
                                        placeholder="John Doe"
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
                                    </label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        value="{{ old('email') }}"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('email') border-red-500 @enderror"
                                        placeholder="nama@email.com"
                                    >
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            name="password" 
                                            id="password" 
                                            required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('password') border-red-500 @enderror"
                                            placeholder="Minimal 8 karakter"
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
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-gray-400"></i>Konfirmasi Password
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            id="password_confirmation" 
                                            required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                                            placeholder="Ulangi password"
                                        >
                                        <button 
                                            type="button" 
                                            onclick="togglePassword('password_confirmation')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        >
                                            <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="mt-4 mb-5">
                                <label class="flex items-start">
                                    <input 
                                        type="checkbox" 
                                        name="terms" 
                                        required
                                        class="w-4 h-4 mt-1 text-red-600 border-gray-300 rounded focus:ring-red-500"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">
                                        Saya menyetujui <a href="#" class="text-red-600 hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-red-600 hover:underline">Kebijakan Privasi</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl mb-4"
                            >
                                <i class="fas fa-user-plus mr-2"></i>Daftar
                            </button>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="text-gray-600 text-sm">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-semibold hover:underline">
                                        Masuk
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