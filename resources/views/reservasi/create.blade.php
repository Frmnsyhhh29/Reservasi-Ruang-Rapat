@extends('layouts.app')

@section('title', 'Buat Reservasi')

@section('content')
<div class="max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-5 flex items-center">
        <i class="fas fa-calendar-plus text-red-600 mr-2"></i> Buat Reservasi
    </h1>

    <div class="bg-white shadow p-6 rounded-lg">
        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf

            <!-- Ruangan -->
            <div class="mb-5">
                <label class="font-semibold">Ruangan</label>
                <select name="room_id" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} (Kapasitas: {{ $room->capacity }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-5">
                <label class="font-semibold">Tanggal</label>
                <input type="date" id="date" name="date" 
                    min="{{ now()->format('Y-m-d') }}"
                    required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <!-- Jam Mulai -->
            <div class="mb-5">
                <label class="font-semibold">Jam Mulai</label>
                <input type="time" id="start_time" name="start_time" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <!-- Jam Selesai -->
            <div class="mb-5">
                <label class="font-semibold">Jam Selesai</label>
                <input type="time" id="end_time" name="end_time" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <!-- Info -->
            <div class="bg-red-50 text-sm p-3 rounded border border-red-200 mb-5">
                <strong class="text-red-800">Catatan:</strong>
                <ul class="list-disc ml-4 text-red-700">
                    <li>Tanggal selesai otomatis mengikuti tanggal mulai.</li>
                    <li>Jam selesai harus lebih besar dari jam mulai.</li>
                </ul>
            </div>

            <!-- Tombol -->
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white w-full py-3 rounded font-semibold transition">
                <i class="fas fa-save mr-2"></i>Simpan Reservasi
            </button>
        </form>
    </div>
</div>

<script>
    const startInput = document.getElementById("start_time");
    const endInput = document.getElementById("end_time");

    startInput.addEventListener("change", function () {
        if (!this.value) return;

        let [hour, minute] = this.value.split(":");
        hour = Number(hour) + 1;

        // set jam selesai auto +1 jam
        endInput.value = `${hour.toString().padStart(2, '0')}:${minute}`;
    });

    endInput.addEventListener("change", function () {
        if (!startInput.value) return;

        const [sH, sM] = startInput.value.split(":");
        const [eH, eM] = this.value.split(":");

        const start = new Date();
        start.setHours(sH, sM);
        
        const end = new Date();
        end.setHours(eH, eM);

        if (end <= start) {
            alert("⛔ Jam selesai harus lebih besar dari jam mulai.");
            start.setHours(start.getHours() + 1);
            this.value = `${start.getHours().toString().padStart(2,'0')}:${sM}`;
        }
    });
</script>

@endsection