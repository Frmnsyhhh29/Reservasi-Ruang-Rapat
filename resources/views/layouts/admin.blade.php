<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white fixed h-full">
            <div class="p-6 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold flex items-center">
                    <i class="fas fa-building mr-2"></i>RoomBook
                </a>
                <span class="text-xs text-gray-400 mt-1 block">Admin Panel</span>
            </div>
            
            <nav class="p-4">
                <p class="text-xs text-gray-500 uppercase mb-4">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.rooms.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.rooms.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <i class="fas fa-door-open w-5"></i>
                    <span>Kelola Ruangan</span>
                </a>
                
                <a href="{{ route('admin.reservations.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.reservations.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Kelola Reservasi</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <i class="fas fa-users w-5"></i>
                    <span>Kelola User</span>
                </a>

                <!-- Tambahkan menu ini -->
                <a href="{{ route('admin.admins.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 {{ request()->routeIs('admin.admins.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }} transition">
                    <i class="fas fa-user-shield w-5"></i>
                    <span>Kelola Admin</span>
                </a>

                <div class="border-t border-gray-700 my-4"></div>
                
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg mb-2 text-gray-300 hover:bg-gray-700 transition">
                    <i class="fas fa-globe w-5"></i>
                    <span>Lihat Website</span>
                </a>
                
                <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/20 transition">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span>Logout</span>
            </button>
        </form>
            </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    @auth('admin')
                        <span class="text-gray-600">{{ Auth::guard('admin')->user()->name }}</span>
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                        </div>
                    @else
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endauth
                </div>
            </header>

            <!-- Alert Messages -->
            <div class="px-8 pt-6">
                @if(session('success'))
                    <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>