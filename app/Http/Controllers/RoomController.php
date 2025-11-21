<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    // Menampilkan semua ruangan yang tersedia
    public function index(Request $request)
    {
        $rooms = Room::withCount(['reservations' => function ($query) {
            $query->where('end_time', '>', now());
        }])->get();

        // Filter berdasarkan kapasitas jika ada
        if ($request->has('capacity') && $request->capacity) {
            $rooms = $rooms->where('capacity', '>=', $request->capacity);
        }

        return view('rooms.index', compact('rooms'));
    }

    // Detail ruangan dengan jadwal reservasi
    public function show(Room $room)
    {
        // Ambil reservasi yang akan datang untuk ruangan ini
        $upcomingReservations = Reservation::with('user')
            ->where('room_id', $room->id)
            ->where('end_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->get();

        return view('rooms.show', compact('room', 'upcomingReservations'));
    }
}