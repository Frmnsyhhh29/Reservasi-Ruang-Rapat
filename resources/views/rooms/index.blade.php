@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-door-open text-red-600 mr-2"></i>Daftar Ruangan
        </h1>
        <p class="text-gray-600 mt-2">Temukan ruangan yang sesuai dengan kebutuhan Anda</p>
    </div>
    @auth
        <a href="{{ route('reservasi.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition shadow-md">
            <i class="fas fa-plus mr-2"></i>Buat Reservasi
        </a>
    @endauth
</div>

<!-- Filter -->
<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <form action="{{ route('rooms.index') }}" method="GET" class="flex items-end gap-4">
        <div class="flex-1">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-users mr-1"></i>Filter Kapasitas Minimal
            </label>
            <select name="capacity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <option value="">Semua Kapasitas</option>
                <option value="5" {{ request('capacity') == '5' ? 'selected' : '' }}>5+ orang</option>
                <option value="10" {{ request('capacity') == '10' ? 'selected' : '' }}>10+ orang</option>
                <option value="20" {{ request('capacity') == '20' ? 'selected' : '' }}>20+ orang</option>
                <option value="50" {{ request('capacity') == '50' ? 'selected' : '' }}>50+ orang</option>
            </select>
        </div>
        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900 transition">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
        @if(request()->hasAny(['capacity']))
            <a href="{{ route('rooms.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2">
                <i class="fas fa-times mr-1"></i>Reset
            </a>
        @endif
    </form>
</div>

<!-- Room Grid -->
@if($rooms->count() > 0)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                
                <!-- Room Info -->
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $room->name }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ $room->description ?? 'Ruangan nyaman untuk berbagai keperluan.' }}
                </p>
                
                <!-- Room Stats -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>{{ $room->capacity }} orang</span>
                    </div>
                    <div class="flex items-center">
                        @if($room->reservations_count > 0)
                            <span class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full">
                                {{ $room->reservations_count }} reservasi aktif
                            </span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                Tersedia
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <a href="{{ route('rooms.show', $room) }}" 
                        class="flex-1 text-center bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition">
                        <i class="fas fa-eye mr-1"></i>Detail
                    </a>
                    @auth
                        <a href="{{ route('reservasi.create', ['room_id' => $room->id]) }}" 
                            class="flex-1 text-center bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                            <i class="fas fa-calendar-plus mr-1"></i>Pesan
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <i class="fas fa-door-closed text-gray-300 text-6xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada ruangan ditemukan</h3>
        <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
    </div>
@endif
@endsection