<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Meeting Reservation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-red-50 via-white to-red-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-10 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full backdrop-blur-sm mb-4 shadow-lg">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Admin Panel</h1>
                    <p class="text-red-100">Meeting Reservation System</p>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
                        <p class="text-gray-600 text-sm">Silakan login untuk melanjutkan</p>
                    </div>

                    <!-- Error Messages -->
                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-5 flex items-start">
                            <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                            <span class="text-sm">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-5">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                                <div class="text-sm">
                                    @foreach($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Admin
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email"
                                    value="{{ old('email') }}"
                                    required 
                                    autofocus
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                                    placeholder="admin@example.com"
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password"
                                    required
                                    class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                                    placeholder="••••••••"
                                >
                                <button 
                                    type="button" 
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition"
                                >
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember"
                                class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-4 rounded-lg font-semibold hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </button>
                    </form>

                    <!-- Security Notice -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-start gap-2 text-xs text-gray-500">
                            <i class="fas fa-shield-alt text-red-500 mt-0.5"></i>
                            <p>Halaman ini dilindungi. Hanya administrator yang memiliki akses.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Home Link -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-red-600 hover:text-red-800 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali ke Halaman Utama</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>