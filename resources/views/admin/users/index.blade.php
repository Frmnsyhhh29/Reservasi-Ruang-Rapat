@extends('admin.layouts.app')

@section('page-title', 'Kelola Users')
@section('page-description', 'Manajemen pengguna sistem')

@section('title', 'Kelola Users')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Kelola User</h1>
    <p class="text-gray-600">Kelola semua pengguna sistem</p>
</div>

<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <div></div>
    <a href="{{ route('admin.users.create') }}" class="bg-red-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-red-600 transition">
        Tambah User
    </a>
</div>

<!-- Search -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <div class="grid md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-2">Cari User</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau email..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-red-600 text-white px-4 py-2.5 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Role</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Reservasi</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Terdaftar</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-600">{{ $users->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->is_admin)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Admin</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->reservations_count }} reservasi</td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.show', $user) }}" class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini? Semua reservasi user ini juga akan dihapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="bg-gray-100 text-gray-400 p-2 rounded-lg cursor-not-allowed" title="Tidak bisa hapus diri sendiri">
                                    <i class="fas fa-trash"></i>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-users text-4xl mb-3"></i>
                            <p>Tidak ada user ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection