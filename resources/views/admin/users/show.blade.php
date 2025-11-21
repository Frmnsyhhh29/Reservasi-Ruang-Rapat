@extends('admin.layouts.app')

@section('page-title', 'Detail User')
@section('page-description', 'Informasi lengkap pengguna')

@section('title', 'Detail User')

@section('content')
<!-- Breadcrumb -->
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-red-600 inline-flex items-center">
                <i class="fas fa-users mr-2"></i>
                Kelola Users
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-gray-500">Detail User</span>
            </div>
        </li>
    </ol>
</nav>

<!-- User Details Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-white/20 p-4 rounded-full mr-4">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                    <p class="text-red-100 mt-1">{{ $user->email }}</p>
                    <div class="mt-2">
                        @if($user->is_admin)
                            <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-medium">Administrator</span>
                        @else
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">User</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- User Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-red-600 mr-2"></i>
                    Informasi User
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Nama:</span>
                        <span class="text-sm text-gray-900 font-medium">{{ $user->name }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Email:</span>
                        <span class="text-sm text-gray-900">{{ $user->email }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Role:</span>
                        @if($user->is_admin)
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-medium">Administrator</span>
                        @else
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-medium">User</span>
                        @endif
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Terdaftar:</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Terakhir Update:</span>
                        <span class="text-sm text-gray-900">{{ $user->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-red-600 mr-2"></i>
                    Statistik Aktivitas
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-blue-600 font-medium">Total Reservasi</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $user->reservations->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-green-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-green-600 font-medium">Akan Datang</p>
                                <p class="text-2xl font-bold text-green-900">{{ $user->reservations->where('start_time', '>', now())->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Reservations -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-history text-red-600 mr-2"></i>
            Riwayat Reservasi
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ruangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($user->reservations->take(10) as $reservation)
                    @php
                        $isPast = $reservation->end_time < now();
                        $isOngoing = $reservation->start_time <= now() && $reservation->end_time >= now();
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-red-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-door-open text-red-600"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $reservation->room->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $reservation->start_time->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($isPast)
                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Selesai</span>
                            @elseif($isOngoing)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Berlangsung</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Akan Datang</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-calendar-times text-4xl mb-3"></i>
                                <p>User ini belum pernah membuat reservasi</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Action Buttons -->
<div class="flex justify-between items-center mt-8">
    <a href="{{ route('admin.users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>
    
    <div class="flex space-x-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-yellow-700 transition flex items-center gap-2">
            <i class="fas fa-edit"></i>
            <span>Edit User</span>
        </a>
        
        @if($user->id !== Auth::id())
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini? Semua reservasi terkait akan ikut terhapus.')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2">
                    <i class="fas fa-trash"></i>
                    <span>Hapus User</span>
                </button>
            </form>
        @endif
    </div>
</div>
@endsection