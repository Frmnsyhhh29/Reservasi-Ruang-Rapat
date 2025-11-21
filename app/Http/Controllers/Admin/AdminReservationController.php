<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'room']);

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->filled('status')) {
            switch ($request->status) {
                case 'upcoming':
                    $query->where('start_time', '>', now());
                    break;
                case 'ongoing':
                    $query->where('start_time', '<=', now())
                          ->where('end_time', '>=', now());
                    break;
                case 'past':
                    $query->where('end_time', '<', now());
                    break;
            }
        }

        if ($request->filled('date')) {
            $query->whereDate('start_time', $request->date);
        }

        $reservations = $query->latest()->paginate(10);
        $rooms = Room::all();
        
        return view('admin.reservations.index', compact('reservations', 'rooms'));
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        $rooms = Room::all();
        return view('admin.reservations.form', compact('users', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $conflict = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<=', $request->start_time)
                          ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'Ruangan sudah dipesan pada waktu tersebut.'])
                ->withInput();
        }

        Reservation::create($request->all());

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil ditambahkan.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'room']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $users = User::where('is_admin', false)->get();
        $rooms = Room::all();
        return view('admin.reservations.form', compact('reservation', 'users', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $conflict = Reservation::where('room_id', $request->room_id)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<=', $request->start_time)
                          ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'Ruangan sudah dipesan pada waktu tersebut.'])
                ->withInput();
        }

        $reservation->update($request->all());

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }
}