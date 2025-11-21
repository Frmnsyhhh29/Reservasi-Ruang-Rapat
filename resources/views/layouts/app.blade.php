<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Reservasi Ruang Rapat')</title>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Icon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-700 flex flex-col min-h-screen antialiased">

    <!-- 🔹 Navbar -->
    <header class="bg-red-600 border-b shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 font-bold text-lg text-white">
                <i class="fa-solid fa-calendar-check"></i> RuangRapat
            </a>

            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-white hover:text-red-200">Home</a>
                <a href="{{ route('rooms.index') }}" class="text-white hover:text-red-200">Ruangan</a>

                @auth
                    <a href="{{ route('reservasi.create') }}" class="text-white hover:text-red-200">Reservasi</a>
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-red-200">Riwayat</a>

                    <form action="{{ route('logout') }}" method="POST" onsubmit="clearHistory()">
                        @csrf
                        <button class="bg-white text-red-600 px-4 py-2 rounded-lg hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-white text-white hover:bg-white hover:text-red-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-white text-red-600 hover:bg-red-50">Register</a>
                    <a href="{{ route('admin.login') }}" class="text-white hover:text-red-200 text-sm">Admin</a>
                @endauth
            </nav>

            <!-- Mobile Button -->
            <button id="menuBtn" class="md:hidden text-xl text-white">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- 🔹 Mobile Menu -->
        <div id="mobileMenu" class="hidden flex-col px-6 pb-4 space-y-3 bg-red-600 border-t">
            <a href="{{ route('home') }}" class="text-white hover:text-red-200">Home</a>
            <a href="{{ route('rooms.index') }}" class="text-white hover:text-red-200">Ruangan</a>

            @auth
                <a href="{{ route('reservasi.create') }}" class="text-white hover:text-red-200">Reservasi</a>
                <a href="{{ route('dashboard') }}" class="text-white hover:text-red-200">Riwayat</a>
                <form action="{{ route('logout') }}" method="POST" onsubmit="clearHistory()">
                    @csrf
                    <button class="w-full bg-white text-red-600 px-4 py-2 rounded hover:bg-red-50">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-full text-center px-4 py-2 rounded border border-white text-white hover:bg-white hover:text-red-600 transition">Login</a>
                <a href="{{ route('register') }}" class="w-full text-center px-4 py-2 rounded bg-white text-red-600 hover:bg-red-50">Register</a>
                <a href="{{ route('admin.login') }}" class="text-white hover:text-red-200">Admin Login</a>
            @endauth
        </div>
    </header>

    <!-- 🔹 Alert Box -->
    <div class="max-w-5xl mx-auto px-6 mt-5">
        @if(session('success'))
            <div class="p-4 rounded-lg bg-green-100 text-green-700 border border-green-300 mb-4">
                <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-lg bg-red-100 text-red-700 border border-red-300 mb-4">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif
    </div>

    <!-- 🔹 Main Content -->
    <main class="max-w-7xl mx-auto w-full px-6 py-10">
        @yield('content')
    </main>

    <!-- 🔹 Footer -->
    <footer class="mt-auto py-6 text-center bg-white border-t">
        <p class="text-sm text-gray-500">
            © {{ date('Y') }} RuangRapat — Sistem Reservasi Ruang Rapat
        </p>
    </footer>

    <!-- Script Toggle Menu -->
    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        
        // Clear browser history on logout
        function clearHistory() {
            // Clear session storage
            sessionStorage.clear();
            
            // Clear local storage (optional)
            localStorage.clear();
            
            // Prevent back button
            setTimeout(function() {
                history.replaceState(null, null, window.location.href);
                window.onpopstate = function() {
                    history.go(1);
                };
            }, 100);
        }
        
        // Prevent back button after logout
        if (performance.navigation.type === 2) {
            // User came from back button
            @auth
                // User is authenticated, allow normal behavior
            @else
                // User is not authenticated, redirect to home
                window.location.replace('{{ route("home") }}');
            @endauth
        }
    </script>

</body>
</html>