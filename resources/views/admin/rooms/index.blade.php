@extends('admin.layouts.app')

@section('page-title', 'Kelola Ruangan')
@section('page-description', 'Manajemen ruangan meeting')

@section('title', 'Kelola Ruangan')

@section('content')

<!-- Action Buttons -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div class="flex items-center space-x-4">
        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border">
            <span class="text-sm text-gray-600">Total: <span class="font-semibold text-gray-900">{{ $rooms->total() }}</span> ruangan</span>
        </div>
    </div>
    
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.rooms.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Ruangan</span>
        </a>
        <button onclick="window.print()" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition-colors flex items-center gap-2">
            <i class="fas fa-print"></i>
            <span class="hidden sm:inline">Print</span>
        </button>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Ruangan</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Deskripsi</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Kapasitas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Reservasi</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($rooms as $index => $room)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-600">{{ $rooms->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-door-open text-red-600"></i>
                            </div>
                            <span class="font-medium text-gray-800">{{ $room->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ $room->description ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            {{ $room->capacity }} orang
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $room->reservations_count }} reservasi</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.rooms.show', $room) }}" class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-door-closed text-4xl mb-3"></i>
                            <p>Belum ada ruangan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($rooms->hasPages())
    <div class="mt-6">
        {{ $rooms->links() }}
    </div>
@endif
@endsection