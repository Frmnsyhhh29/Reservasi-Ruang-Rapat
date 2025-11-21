@extends('admin.layouts.app')

@section('page-title', isset($reservation) ? 'Edit Reservasi' : 'Tambah Reservasi')
@section('page-description', isset($reservation) ? 'Ubah data reservasi' : 'Buat reservasi baru')

@section('title', isset($reservation) ? 'Edit Reservasi' : 'Tambah Reservasi')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">{{ isset($reservation) ? 'Edit Reservasi' : 'Tambah Reservasi' }}</h1>
    <nav class="mt-2">
        <ol class="flex items-center gap-2 text-sm text-gray-600">
            <li><a href="{{ route('admin.reservations.index') }}" class="hover:text-blue-600">Kelola Reservasi</a></li>
            <li>></li>
            <li class="text-gray-800 font-medium">{{ isset($reservation) ? 'Edit' : 'Tambah' }}</li>
        </ol>
    </nav>
</div>

<!-- Form Card -->
<div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ isset($reservation) ? route('admin.reservations.update', $reservation) : route('admin.reservations.store') }}" method="POST">
            @csrf
            @if(isset($reservation))
                @method('PUT')
            @endif

            <!-- User -->
            <div class="mb-6">
                <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    User <span class="text-red-500">*</span>
                </label>
                <select 
                    name="user_id" 
                    id="user_id" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('user_id') border-red-500 @enderror"
                >
                    <option value="">Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $reservation->user_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room -->
            <div class="mb-6">
                <label for="room_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Ruangan <span class="text-red-500">*</span>
                </label>
                <select 
                    name="room_id" 
                    id="room_id" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('room_id') border-red-500 @enderror"
                >
                    <option value="">Pilih Ruangan</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $reservation->room_id ?? '') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }} (Kapasitas: {{ $room->capacity }} orang)
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Time -->
            <div class="mb-6">
                <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">
                    Waktu Mulai <span class="text-red-500">*</span>
                </label>
                <input 
                    type="datetime-local" 
                    name="start_time" 
                    id="start_time" 
                    value="{{ old('start_time', isset($reservation) ? $reservation->start_time->format('Y-m-d\TH:i') : '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('start_time') border-red-500 @enderror"
                >
                @error('start_time')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div class="mb-8">
                <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">
                    Waktu Selesai <span class="text-red-500">*</span>
                </label>
                <input 
                    type="datetime-local" 
                    name="end_time" 
                    id="end_time" 
                    value="{{ old('end_time', isset($reservation) ? $reservation->end_time->format('Y-m-d\TH:i') : '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('end_time') border-red-500 @enderror"
                >
                @error('end_time')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-save mr-2"></i>{{ isset($reservation) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.reservations.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
</div>
@endsection