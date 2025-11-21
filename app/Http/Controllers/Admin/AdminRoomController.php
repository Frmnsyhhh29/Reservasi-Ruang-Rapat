<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('reservations')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        $room->load(['reservations' => function($query) {
            $query->with('user')->latest();
        }]);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.form', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->reservations()->count() > 0) {
            return redirect()->route('admin.rooms.index')
                ->with('error', 'Tidak dapat menghapus ruangan yang memiliki reservasi.');
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}