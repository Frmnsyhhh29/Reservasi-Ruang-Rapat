@extends('admin.layouts.app')

@section('page-title', isset($user) ? 'Edit User' : 'Tambah User')
@section('page-description', isset($user) ? 'Ubah data pengguna' : 'Buat pengguna baru')

@section('title', isset($user) ? 'Edit User' : 'Tambah User')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h1>
    <nav class="mt-2">
        <ol class="flex items-center gap-2 text-sm text-gray-600">
            <li><a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Kelola User</a></li>
            <li>></li>
            <li class="text-gray-800 font-medium">{{ isset($user) ? 'Edit' : 'Tambah' }}</li>
        </ol>
    </nav>
</div>

<!-- Form Card -->
<div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <!-- Nama -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $user->name ?? '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('name') border-red-500 @enderror"
                    placeholder="John Doe"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email', $user->email ?? '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('email') border-red-500 @enderror"
                    placeholder="nama@email.com"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password @if(!isset($user))<span class="text-red-500">*</span>@endif
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    {{ !isset($user) ? 'required' : '' }}
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition @error('password') border-red-500 @enderror"
                    placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 8 karakter' }}"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                @if(isset($user))
                    <p class="text-gray-500 text-sm mt-2">Kosongkan jika tidak ingin mengubah password</p>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konfirmasi Password @if(!isset($user))<span class="text-red-500">*</span>@endif
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                    placeholder="Ulangi password"
                >
            </div>

            <!-- Role -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Role</label>
                <div class="flex gap-6">
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="is_admin" 
                            value="0" 
                            {{ old('is_admin', $user->is_admin ?? 0) == 0 ? 'checked' : '' }}
                            class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500"
                        >
                        <span class="ml-2 text-gray-700">User</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="is_admin" 
                            value="1" 
                            {{ old('is_admin', $user->is_admin ?? 0) == 1 ? 'checked' : '' }}
                            class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500"
                        >
                        <span class="ml-2 text-gray-700">Admin</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-save mr-2"></i>{{ isset($user) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
</div>
@endsection