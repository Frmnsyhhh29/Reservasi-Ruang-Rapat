@extends('admin.layouts.app')

@section('page-title', 'Detail Ruangan')
@section('page-description', 'Informasi lengkap ruangan')

@section('title', 'Detail Ruangan')

@section('content')
<!-- Breadcrumb -->
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.rooms.index') }}" class="text-gray-700 hover:text-red-600 inline-flex items-center">
                <i class="fas fa-door-open mr-2"></i>
                Kelola Ruangan
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-gray-500">Detail Ruangan</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Room Details Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-white/20 p-4 rounded-full mr-4">
                    <i class="fas fa-door-open text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $room->name }}</h1>
                    <p class="text-red-100 mt-1">Kapasitas: {{ $room->capacity }} orang</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Room Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-red-600 mr-2"></i>
                    Informasi Ruangan
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Nama:</span>
                        <span class="text-sm text-gray-900 font-medium">{{ $room->name }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Kapasitas:</span>
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-medium">{{ $room->capacity }} orang</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Deskripsi:</span>
                        <span class="text-sm text-gray-900">{{ $room->description ?: 'Tidak ada deskripsi' }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Dibuat:</span>
                        <span class="text-sm text-gray-900">{{ $room->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Diupdate:</span>
                        <span class="text-sm text-gray-900">{{ $room->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-red-600 mr-2"></i>
                    Statistik Reservasi
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-blue-600 font-medium">Total Reservasi</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $room->reservations->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-green-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-green-600 font-medium">Akan Datang</p>
                                <p class="text-2xl font-bold text-green-900">{{ $room->reservations->where('start_time', '>', now())->count() }}</p>
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
            Reservasi Terbaru
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($room->reservations->take(10) as $reservation)
                    @php
                        $isPast = $reservation->end_time < now();
                        $isOngoing = $reservation->start_time <= now() && $reservation->end_time >= now();
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-red-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-user text-red-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                                </div>
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
                                <p>Belum ada reservasi untuk ruangan ini</p>
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
    <a href="{{ route('admin.rooms.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>
    
    <div class="flex space-x-3">
        <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-yellow-700 transition flex items-center gap-2">
            <i class="fas fa-edit"></i>
            <span>Edit Ruangan</span>
        </a>
        
        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ruangan ini? Semua reservasi terkait akan ikut terhapus.')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2">
                <i class="fas fa-trash"></i>
                <span>Hapus Ruangan</span>
            </button>
        </form>
    </div>
</div>
@endsection