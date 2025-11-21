@extends('layouts.app')

@section('title', $room->name . ' - Detail Ruangan')

@section('content')

<!-- Breadcrumb -->
<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm text-gray-600">
        <li><a href="{{ route('rooms.index') }}" class="hover:text-red-600">Ruangan</a></li>
        <li><i class="fas fa-chevron-right text-xs"></i></li>
        <li class="text-gray-800 font-medium">{{ $room->name }}</li>
    </ol>
</nav>

<div class="grid lg:grid-cols-3 gap-8">

    <!-- Room Information -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-md p-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                <i class="fas fa-door-open text-red-600"></i> {{ $room->name }}
            </h1>

            <!-- Status & Capacity -->
            <div class="flex items-center flex-wrap gap-3 mb-6">
                <span class="bg-red-100 text-red-800 px-4 py-1 rounded-full text-sm">
                    <i class="fas fa-users mr-2"></i>Kapasitas {{ $room->capacity }} orang
                </span>

                @if($upcomingReservations->count() == 0)
                    <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                        <i class="fas fa-check-circle mr-2"></i>Tersedia
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div class="text-gray-700 leading-relaxed">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                <p>{{ $room->description ?? 'Ruangan ini dilengkapi fasilitas modern dan cocok untuk rapat, presentasi, workshop, atau pertemuan internal.' }}</p>
            </div>

            <!-- Facilities -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Fasilitas</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(['AC', 'Proyektor', 'Whiteboard', 'WiFi'] as $facility)
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">
                            <i class="fas fa-check text-green-500 mr-1"></i>{{ $facility }}
                        </span>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">

        <!-- Booking Box -->
        @auth
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                <i class="fas fa-calendar-plus text-red-600 mr-2"></i>Buat Reservasi
            </h3>

            <a href="{{ route('reservasi.create', ['room_id' => $room->id]) }}"
                class="block w-full bg-red-600 text-white text-center py-3 rounded-lg hover:bg-red-700 transition font-medium">
                Reservasi Sekarang
            </a>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Ingin Memesan?</h3>
            <p class="text-gray-600 text-sm mb-3">Masuk terlebih dahulu untuk melanjutkan proses reservasi.</p>

            <a href="{{ route('login') }}"
                class="block w-full bg-red-600 text-white text-center py-3 rounded-lg hover:bg-red-700 transition font-medium">
                Login
            </a>
        </div>
        @endauth

        <!-- Schedule -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-clock text-amber-500"></i>Jadwal Mendatang
            </h3>

            @if($upcomingReservations->count() > 0)
                <div class="space-y-3">

                    @foreach($upcomingReservations->take(5) as $reservation)

                    <div class="border-l-4 border-red-500 pl-3 py-2">
                        <p class="text-gray-800 font-medium">
                            {{ $reservation->start_time->format('d M Y') }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}
                        </p>
                        <p class="text-xs text-gray-500">
                            oleh {{ $reservation->user->name ?? 'User' }}
                        </p>
                    </div>

                    @endforeach

                </div>

                @if($upcomingReservations->count() > 5)
                    <p class="text-sm text-gray-500 mt-2">
                        +{{ $upcomingReservations->count() - 5 }} reservasi lainnya
                    </p>
                @endif

            @else
                <div class="text-center py-4">
                    <i class="fas fa-calendar-check text-green-500 text-3xl mb-2"></i>
                    <p class="text-gray-700 font-medium">Tidak ada reservasi mendatang</p>
                    <p class="text-sm text-gray-500">Ruangan masih tersedia</p>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection