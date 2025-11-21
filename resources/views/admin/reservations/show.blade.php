@extends('admin.layouts.app')

@section('page-title', 'Detail Reservasi')
@section('page-description', 'Informasi lengkap reservasi')

@section('title', 'Detail Reservasi')

@section('content')
<!-- Breadcrumb -->
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.reservations.index') }}" class="text-gray-700 hover:text-red-600 inline-flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                Kelola Reservasi
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                <span class="text-gray-500">Detail Reservasi</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Reservation Details Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-white/20 p-4 rounded-full mr-4">
                    <i class="fas fa-calendar-check text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $reservation->room->name }}</h1>
                    <p class="text-red-100 mt-1">{{ $reservation->start_time->format('d F Y') }}</p>
                    <div class="mt-2">
                        @php
                            $isPast = $reservation->end_time < now();
                            $isOngoing = $reservation->start_time <= now() && $reservation->end_time >= now();
                        @endphp
                        @if($isPast)
                            <span class="bg-gray-400 text-white px-3 py-1 rounded-full text-sm font-medium">Selesai</span>
                        @elseif($isOngoing)
                            <span class="bg-green-400 text-white px-3 py-1 rounded-full text-sm font-medium">Berlangsung</span>
                        @else
                            <span class="bg-blue-400 text-white px-3 py-1 rounded-full text-sm font-medium">Akan Datang</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.reservations.edit', $reservation) }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Reservation Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-red-600 mr-2"></i>
                    Informasi Reservasi
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">ID:</span>
                        <span class="text-sm text-gray-900 font-medium">#{{ $reservation->id }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">User:</span>
                        <div>
                            <span class="text-sm text-gray-900 font-medium">{{ $reservation->user->name }}</span>
                            <br>
                            <span class="text-xs text-gray-500">{{ $reservation->user->email }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Ruangan:</span>
                        <div>
                            <span class="text-sm text-gray-900 font-medium">{{ $reservation->room->name }}</span>
                            <br>
                            <span class="text-xs text-gray-500">Kapasitas: {{ $reservation->room->capacity }} orang</span>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Tanggal:</span>
                        <span class="text-sm text-gray-900">{{ $reservation->start_time->format('l, d F Y') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Waktu:</span>
                        <span class="text-sm text-gray-900">{{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Durasi:</span>
                        <span class="text-sm text-gray-900">{{ $reservation->start_time->diffInHours($reservation->end_time) }} jam</span>
                    </div>
                </div>
            </div>

            <!-- Timeline & Status -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clock text-red-600 mr-2"></i>
                    Timeline & Status
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Dibuat:</span>
                        <span class="text-sm text-gray-900">{{ $reservation->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Diupdate:</span>
                        <span class="text-sm text-gray-900">{{ $reservation->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-sm font-medium text-gray-500 w-24">Status:</span>
                        @if($isPast)
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm font-medium">Selesai</span>
                        @elseif($isOngoing)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm font-medium">Berlangsung</span>
                        @else
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-medium">Akan Datang</span>
                        @endif
                    </div>
                    
                    @if(!$isPast)
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-500 w-24">Countdown:</span>
                            <span class="text-sm text-gray-900">
                                @if($isOngoing)
                                    Berakhir dalam {{ $reservation->end_time->diffForHumans() }}
                                @else
                                    Dimulai {{ $reservation->start_time->diffForHumans() }}
                                @endif
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Quick Actions -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Quick Actions</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.users.show', $reservation->user) }}" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition">
                            <i class="fas fa-user mr-1"></i>Lihat User
                        </a>
                        <a href="{{ route('admin.rooms.show', $reservation->room) }}" class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200 transition">
                            <i class="fas fa-door-open mr-1"></i>Lihat Ruangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="flex justify-between items-center mt-8">
    <a href="{{ route('admin.reservations.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition flex items-center gap-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>
    
    <div class="flex space-x-3">
        <a href="{{ route('admin.reservations.edit', $reservation) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-yellow-700 transition flex items-center gap-2">
            <i class="fas fa-edit"></i>
            <span>Edit Reservasi</span>
        </a>
        
        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2">
                <i class="fas fa-trash"></i>
                <span>Hapus Reservasi</span>
            </button>
        </form>
    </div>
</div>
@endsection