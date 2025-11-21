@extends('admin.layouts.app')

@section('page-title', 'Kelola Reservasi')
@section('page-description', 'Manajemen reservasi ruangan')

@section('title', 'Kelola Reservasi')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Kelola Reservasi</h1>
    <p class="text-gray-600">Kelola semua reservasi ruangan</p>
</div>

<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <div></div>
    <a href="{{ route('admin.reservations.create') }}" class="bg-red-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-red-600 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Reservasi
    </a>
</div>

<!-- Filter -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <form action="{{ route('admin.reservations.index') }}" method="GET">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-2">Ruangan</label>
                <select name="room_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Ruangan</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-2">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-red-600 text-white px-4 py-2.5 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request()->hasAny(['room_id', 'status', 'date']))
                    <a href="{{ route('admin.reservations.index') }}" class="px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
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
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">User</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Ruangan</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Waktu</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($reservations as $index => $reservation)
                @php
                    $isPast = $reservation->end_time < now();
                    $isOngoing = $reservation->start_time <= now() && $reservation->end_time >= now();
                @endphp
                <tr class="hover:bg-gray-50 transition {{ $isPast ? 'opacity-60' : '' }}">
                    <td class="px-6 py-4 text-gray-600">{{ $reservations->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-semibold text-sm">
                                {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $reservation->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $reservation->room->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $reservation->start_time->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($isPast)
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                        @elseif($isOngoing)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Berlangsung</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Akan Datang</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.reservations.show', $reservation) }}" class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.reservations.edit', $reservation) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
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
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-calendar-times text-4xl mb-3"></i>
                            <p>Tidak ada reservasi ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($reservations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $reservations->links() }}
        </div>
    @endif
</div>
@endsection