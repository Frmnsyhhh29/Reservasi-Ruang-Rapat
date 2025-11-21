@extends('admin.layouts.app')

@section('page-title', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan')
@section('page-description', isset($room) ? 'Ubah data ruangan' : 'Buat ruangan baru')

@section('title', isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">{{ isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan' }}</h1>
    <nav class="mt-2">
        <ol class="flex items-center gap-2 text-sm text-gray-600">
            <li><a href="{{ route('admin.rooms.index') }}" class="hover:text-blue-600">Kelola Ruangan</a></li>
            <li>></li>
            <li class="text-gray-800 font-medium">{{ isset($room) ? 'Edit' : 'Tambah' }}</li>
        </ol>
    </nav>
</div>

<!-- Form Card -->
<div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" method="POST">
            @csrf
            @if(isset($room))
                @method('PUT')
            @endif

            <!-- Nama Ruangan -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Ruangan <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $room->name ?? '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('name') border-red-500 @enderror"
                    placeholder="Contoh: Ruang Rapat A"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('description') border-red-500 @enderror"
                    placeholder="Deskripsi ruangan dan fasilitas yang tersedia..."
                >{{ old('description', $room->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kapasitas -->
            <div class="mb-8">
                <label for="capacity" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kapasitas <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="number" 
                        name="capacity" 
                        id="capacity" 
                        value="{{ old('capacity', $room->capacity ?? '') }}"
                        required
                        min="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('capacity') border-red-500 @enderror"
                        placeholder="Jumlah orang"
                    >
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">orang</span>
                </div>
                @error('capacity')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-save mr-2"></i>{{ isset($room) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
</div>
@endsection