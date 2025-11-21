<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 1. Melihat riwayat reservasi user
    public function index(Request $request)
    {
        $rooms = Room::all();
        
        // Query dasar
        $query = Reservation::with('room')
                    ->where('user_id', Auth::id());
        
        // Filter berdasarkan status
        if ($request->filter == 'upcoming') {
            $query->where('start_time', '>', now());
        } elseif ($request->filter == 'past') {
            $query->where('end_time', '<', now());
        }
        
        $myReservations = $query->orderBy('start_time', 'desc')->get();

        return view('user.riwayat', compact('rooms', 'myReservations'));
    }

    // 2. Form membuat reservasi
    public function create(Request $request)
    {
        $rooms = Room::all();
        $selectedRoom = $request->get('room_id');
        return view('reservasi.create', compact('rooms', 'selectedRoom'));
    }

    // 3. Menyimpan reservasi (Inti Logika)
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // Gabungkan tanggal dengan jam
        $start = Carbon::parse($request->date . ' ' . $request->start_time);
        $end = Carbon::parse($request->date . ' ' . $request->end_time);

        // Validasi jam selesai harus lebih besar
        if ($end <= $start) {
            return back()->withErrors(['end_time' => 'Jam selesai harus lebih besar dari jam mulai.'])->withInput();
        }

        // Validasi jam kerja 08:00 - 17:00
        if ($start->format('H:i') < '08:00' || $end->format('H:i') > '17:00') {
            return back()->withErrors(['msg' => 'Reservasi hanya bisa dilakukan pada jam kerja (08:00 - 17:00).'])->withInput();
        }

        // Cek konflik (jadwal bentrok)
        $conflict = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['msg' => 'Ruangan sudah dipesan pada waktu tersebut.'])->withInput();
        }

        // Simpan reservasi
        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dibuat!');
    }


    // 4. Membatalkan Reservasi
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // VALIDASI: Hanya pemilik yang bisa membatalkan
        if ($reservation->user_id !== Auth::id()) {
            return back()->withErrors(['msg' => 'Anda tidak memiliki akses untuk membatalkan reservasi ini.']);
        }

        $reservation->delete();

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}