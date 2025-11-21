@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('page-description', 'Overview sistem reservasi ruangan')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Welcome Header -->
<div class="mb-8">
    <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-red-100">Panel Admin Meeting Reservation System</p>
                <p class="text-red-200 text-sm mt-1">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/20 p-4 rounded-full">
                    <i class="fas fa-tachometer-alt text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('admin.rooms.create') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-red-500">
        <div class="flex items-center">
            <div class="bg-red-100 p-3 rounded-full mr-4">
                <i class="fas fa-plus text-red-600"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Tambah Ruangan</h3>
                <p class="text-sm text-gray-600">Buat ruangan baru</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('admin.users.create') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full mr-4">
                <i class="fas fa-user-plus text-blue-600"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Tambah User</h3>
                <p class="text-sm text-gray-600">Buat user baru</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('admin.reservations.create') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full mr-4">
                <i class="fas fa-calendar-plus text-green-600"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Buat Reservasi</h3>
                <p class="text-sm text-gray-600">Reservasi baru</p>
            </div>
        </div>
    </a>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-500 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>User aktif
                </p>
            </div>
            <div class="bg-red-100 p-4 rounded-full">
                <i class="fas fa-users text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-blue-500 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Ruangan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_rooms'] }}</p>
                <p class="text-xs text-blue-600 mt-1">
                    <i class="fas fa-door-open mr-1"></i>Ruangan tersedia
                </p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="fas fa-building text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-500 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Reservasi</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reservations'] }}</p>
                <p class="text-xs text-yellow-600 mt-1">
                    <i class="fas fa-calendar mr-1"></i>Semua waktu
                </p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-full">
                <i class="fas fa-calendar-alt text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-500 hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Reservasi Aktif</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['active_reservations'] }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-clock mr-1"></i>Akan datang
                </p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="fas fa-clock text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Reservations -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                <i class="fas fa-history text-red-600 mr-2"></i>
                Reservasi Terbaru
            </h2>
            <a href="{{ route('admin.reservations.index') }}" class="text-red-600 hover:text-red-800 text-sm font-medium">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Selesai</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recent_reservations as $reservation)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-red-100 p-2 rounded-full mr-3">
                                <i class="fas fa-user text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $reservation->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <i class="fas fa-door-open text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium text-gray-900">{{ $reservation->room->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-green-600 mr-2"></i>
                            {{ $reservation->start_time->format('d/m/Y H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-orange-600 mr-2"></i>
                            {{ $reservation->end_time->format('d/m/Y H:i') }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-calendar-times text-4xl mb-3"></i>
                            <p class="text-lg font-medium">Belum ada reservasi</p>
                            <p class="text-sm">Reservasi akan muncul di sini setelah dibuat</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
