<!-- Sidebar Component -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:relative lg:flex lg:flex-col" id="sidebar">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-gradient-to-r from-red-600 to-red-700">
        <div class="flex items-center">
            <i class="fas fa-shield-alt text-white text-2xl mr-2"></i>
            <span class="text-white text-xl font-bold">Admin Panel</span>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="mt-8 flex-1">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.rooms.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors {{ request()->routeIs('admin.rooms.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                <i class="fas fa-door-open mr-3"></i>
                <span>Kelola Ruangan</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                <i class="fas fa-users mr-3"></i>
                <span>Kelola Users</span>
            </a>
            
            <a href="{{ route('admin.reservations.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors {{ request()->routeIs('admin.reservations.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span>Kelola Reservasi</span>
            </a>
        </div>
        
        <!-- User Info -->
        <div class="absolute bottom-0 w-full p-4 border-t">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-red-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>