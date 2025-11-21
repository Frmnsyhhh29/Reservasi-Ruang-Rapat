<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
// PENTING: Baris ini wajib ada untuk menggunakan Schema
use Illuminate\Support\Facades\Schema; 

class RoomSeeder extends Seeder
{
    public function run()
    {
        // 1. Matikan paksa pengecekan Foreign Key
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel (sekarang aman dilakukan)
        Room::truncate();

        // 3. Hidupkan kembali pengecekan Foreign Key
        Schema::enableForeignKeyConstraints();

        $rooms = [
            [
                'name' => 'Ruang Merapi (Utama)',
                'description' => 'Ruang rapat besar dengan proyektor dan sound system.',
                'capacity' => 20,
            ],
            [
                'name' => 'Ruang Merbabu',
                'description' => 'Ruang diskusi tim menengah, dilengkapi papan tulis.',
                'capacity' => 8,
            ],
            [
                'name' => 'Ruang Sindoro',
                'description' => 'Ruang kedap suara untuk private call atau interview.',
                'capacity' => 4,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}