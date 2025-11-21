@extends('layouts.app')

@section('title', 'Riwayat Reservasi')

@section('content')
<!-- Header -->
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-history text-red-600 mr-2"></i>Riwayat Reservasi
            </h1>
            <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
        <a href="{{ route('reservasi.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i>Reservasi Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="bg-red-100 p-4 rounded-full mr-4">
                <i class="fas fa-calendar text-red-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Reservasi</p>
                <p class="text-2xl font-bold text-gray-800">{{ $myReservations->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="bg-orange-100 p-4 rounded-full mr-4">
                <i class="fas fa-clock text-orange-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Akan Datang</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ $myReservations->where('start_time', '>', now())->count() }}
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="bg-gray-100 p-4 rounded-full mr-4">
                <i class="fas fa-check-circle text-gray-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Selesai</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ $myReservations->where('end_time', '<', now())->count() }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="border-b border-gray-200 px-6 pt-4">
        <nav class="flex gap-4">
            <a href="{{ route('dashboard', ['filter' => 'all']) }}" 
                class="pb-4 px-2 border-b-2 {{ request('filter', 'all') == 'all' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }} font-medium transition">
                Semua
            </a>
            <a href="{{ route('dashboard', ['filter' => 'upcoming']) }}" 
                class="pb-4 px-2 border-b-2 {{ request('filter') == 'upcoming' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }} font-medium transition">
                Akan Datang
            </a>
            <a href="{{ route('dashboard', ['filter' => 'past']) }}" 
                class="pb-4 px-2 border-b-2 {{ request('filter') == 'past' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }} font-medium transition">
                Selesai
            </a>
        </nav>
    </div>

    <!-- Reservation List -->
    @if($myReservations->count() > 0)
        <div class="divide-y divide-gray-100">
            @foreach($myReservations as $reservation)
                @php
                    $isPast = $reservation->end_time < now();
                    $isOngoing = $reservation->start_time <= now() && $reservation->end_time >= now();
                @endphp
                <div class="p-6 hover:bg-gray-50 transition {{ $isPast ? 'opacity-60' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-red-100 p-4 rounded-xl">
                                <i class="fas fa-door-open text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $reservation->room->name }}</h3>
                                <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $reservation->start_time->format('d M Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-users mr-1"></i>
                                        {{ $reservation->room->capacity }} orang
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @if($isPast)
                                <span class="bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-check mr-1"></i>Selesai
                                </span>
                            @elseif($isOngoing)
                                <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-play mr-1"></i>Berlangsung
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-clock mr-1"></i>Akan Datang
                                </span>
                                <form action="{{ route('reservasi.destroy', $reservation->id) }}" method="POST" 
                                    onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                        <i class="fas fa-times mr-1"></i>Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada reservasi</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat reservasi ruangan apapun.</p>
            <a href="{{ route('reservasi.create') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                <i class="fas fa-plus mr-2"></i>Buat Reservasi Pertama
            </a>
        </div>
    @endif
</div>
@endsection