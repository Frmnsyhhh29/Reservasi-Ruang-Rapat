@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-3xl font-bold mb-6">Edit Profil</h1>

    {{-- Status Notifikasi (dari ProfileController@update) --}}
    @if (session('status') === 'profile-updated')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">Profil berhasil diperbarui.</span>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-semibold mb-4">Perbarui Informasi Profil</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Bagian Hapus Akun (Sesuai dengan ProfileController@destroy) --}}
    <div class="bg-white p-6 rounded-lg shadow-lg border border-red-200">
        <h2 class="text-2xl font-semibold mb-4 text-red-600">Hapus Akun</h2>
        <p class="mb-4 text-gray-700">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>

        <button onclick="document.getElementById('delete-user-form').style.display='block'" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Hapus Akun
        </button>

        <form id="delete-user-form" method="POST" action="{{ route('profile.destroy') }}" class="mt-4 p-4 border rounded border-red-400 bg-red-50" style="display: none;">
            @csrf
            @method('delete')

            <h3 class="text-xl font-bold mb-3">Konfirmasi Penghapusan Akun</h3>
            <p class="mb-4">Untuk mengonfirmasi, masukkan kata sandi Anda.</p>

            <div class="mb-4">
                <label for="password_delete" class="block text-gray-700 font-bold mb-2">Kata Sandi</label>
                <input type="password" name="password" id="password_delete" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password', 'userDeletion') border-red-500 @enderror" required>
                @error('password', 'userDeletion')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Hapus Akun Permanen
            </button>
        </form>

        {{-- Script untuk menampilkan error validasi penghapusan akun --}}
        @if ($errors->userDeletion->getMessages())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('delete-user-form').style.display='block';
                });
            </script>
        @endif
    </div>
</div>
@endsection