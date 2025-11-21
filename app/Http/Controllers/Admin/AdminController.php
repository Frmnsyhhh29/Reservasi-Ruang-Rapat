<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('is_admin', false)->count(),
            'total_rooms' => Room::count(),
            'total_reservations' => Reservation::count(),
            'active_reservations' => Reservation::where('start_time', '>', now())->count(),
        ];

        $recent_reservations = Reservation::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations'));
    }
}