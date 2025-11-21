<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // 1. Reset Tabel (Matikan FK check dulu)
        Schema::disableForeignKeyConstraints();
        Reservation::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Ambil Data Pendukung
        // Cari user Budi (User Utama)
        $myUser = User::where('email', 'budi@kantor.com')->first();
        
        // Ambil semua rooms
        $rooms = Room::all();

        // Pastikan data ada sebelum lanjut
        if (!$myUser || $rooms->isEmpty()) {
            $this->command->info('User Budi atau Rooms belum ada. Jalankan UserSeeder & RoomSeeder dulu.');
            return;
        }

        // ---------------------------------------------
        // SKENARIO 1: Buat 2 Reservasi untuk ANDA (Budi)
        // ---------------------------------------------
        
        // Jadwal 1: Besok jam 09:00 - 11:00 di Ruang 1
        Reservation::create([
            'user_id' => $myUser->id,
            'room_id' => $rooms[0]->id, // Ruang Merapi
            'start_time' => Carbon::tomorrow()->setHour(9)->setMinute(0),
            'end_time' => Carbon::tomorrow()->setHour(11)->setMinute(0),
        ]);

        // Jadwal 2: Lusa jam 13:00 - 15:00 di Ruang 2
        Reservation::create([
            'user_id' => $myUser->id,
            'room_id' => $rooms[1]->id, // Ruang Merbabu
            'start_time' => Carbon::now()->addDays(2)->setHour(13)->setMinute(0),
            'end_time' => Carbon::now()->addDays(2)->setHour(15)->setMinute(0),
        ]);

        // ---------------------------------------------
        // SKENARIO 2: Buat Reservasi Orang Lain (Dummy)
        // ---------------------------------------------
        
        // Ambil user acak selain Budi
        $otherUser = User::where('id', '!=', $myUser->id)->first();

        if ($otherUser) {
            // Jadwal Orang Lain: Besok jam 14:00 di Ruang 1
            Reservation::create([
                'user_id' => $otherUser->id,
                'room_id' => $rooms[0]->id, // Ruang Merapi (Konflik potensial jika Anda booking jam ini)
                'start_time' => Carbon::tomorrow()->setHour(14)->setMinute(0),
                'end_time' => Carbon::tomorrow()->setHour(16)->setMinute(0),
            ]);
        }
    }
}