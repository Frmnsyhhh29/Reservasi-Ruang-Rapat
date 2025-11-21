<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Meeting Reservation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <!-- Container Utama dengan Flexbox -->
    <div class="min-h-screen flex">
        
        <!-- SIDEBAR - Width 256px, Hidden di Mobile -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col h-screen bg-white border-r border-gray-200">
                    <!-- Logo -->
                    <div class="flex items-center justify-center h-16 bg-gradient-to-r from-red-600 to-red-700">
                        <i class="fas fa-shield-alt text-white text-2xl mr-2"></i>
                        <span class="text-white text-xl font-bold">Admin Panel</span>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex-1 overflow-y-auto py-6">
                        <div class="px-3 space-y-1">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <a href="{{ route('admin.rooms.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.rooms.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                <i class="fas fa-door-open w-5 mr-3"></i>
                                <span>Kelola Ruangan</span>
                            </a>
                            
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                <i class="fas fa-users w-5 mr-3"></i>
                                <span>Kelola Users</span>
                            </a>
                            
                            <a href="{{ route('admin.reservations.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.reservations.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                <i class="fas fa-calendar-alt w-5 mr-3"></i>
                                <span>Kelola Reservasi</span>
                            </a>
                        </div>
                    </nav>
                    
                    <!-- User Info -->
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <div class="flex items-center w-full">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-red-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}" class="ml-2">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-red-600" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR MOBILE - Overlay -->
        <div class="lg:hidden">
            <div class="fixed inset-0 flex z-40 hidden" id="mobile-sidebar">
                <!-- Overlay Background -->
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" id="sidebar-overlay"></div>
                
                <!-- Sidebar Panel -->
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none" id="close-sidebar">
                            <i class="fas fa-times text-white text-xl"></i>
                        </button>
                    </div>
                    
                    <!-- Logo Mobile -->
                    <div class="flex items-center justify-center h-16 bg-gradient-to-r from-red-600 to-red-700">
                        <i class="fas fa-shield-alt text-white text-2xl mr-2"></i>
                        <span class="text-white text-xl font-bold">Admin Panel</span>
                    </div>
                    
                    <!-- Navigation Mobile -->
                    <nav class="flex-1 px-3 py-6 overflow-y-auto">
                        <div class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <a href="{{ route('admin.rooms.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.rooms.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <i class="fas fa-door-open w-5 mr-3"></i>
                                <span>Kelola Ruangan</span>
                            </a>
                            
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <i class="fas fa-users w-5 mr-3"></i>
                                <span>Kelola Users</span>
                            </a>
                            
                            <a href="{{ route('admin.reservations.index') }}" 
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.reservations.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                <i class="fas fa-calendar-alt w-5 mr-3"></i>
                                <span>Kelola Reservasi</span>
                            </a>
                        </div>
                    </nav>
                    
                    <!-- User Mobile -->
                    <div class="flex-shrink-0 border-t border-gray-200 p-4">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-red-600 text-sm"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA - Flex-1 mengambil sisa space -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Navigation Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button type="button" class="lg:hidden -ml-2 mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100" id="open-sidebar">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            
                            <div>
                                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                                <p class="text-sm text-gray-500">@yield('page-description', 'Kelola sistem reservasi ruangan')</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 hidden sm:block">{{ now()->format('l, d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="rounded-lg bg-green-50 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 text-green-500 hover:bg-green-100" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="rounded-lg bg-red-50 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 text-red-500 hover:bg-red-100" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="rounded-lg bg-red-50 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-red-800 mb-2">Terdapat kesalahan:</h3>
                                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 text-red-500 hover:bg-red-100" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        const openSidebar = document.getElementById('open-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        if (openSidebar) {
            openSidebar.addEventListener('click', function() {
                mobileSidebar.classList.remove('hidden');
            });
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', function() {
                mobileSidebar.classList.add('hidden');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                mobileSidebar.classList.add('hidden');
            });
        }

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>