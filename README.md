SISTEM RESERVASI RUANG RAPAT

1. Skema Database
Berikut adalah tabel-table dari database yang sudah saya buat untuk sistem reservasi ruang rapat

Tabel users :
| Kolom      | Tipe Data | Keterangan           |
| ---------- | --------- | -------------------- |
| id         | int (PK)  | Primary Key          |
| name       | varchar   | Nama user            |
| email      | varchar   | Unique               |
| password   | varchar   | Password terenkripsi |
| created_at | timestamp | waktu dibuat         |
| updated_at | timestamp | waktu update         |

Tabel rooms :
| Kolom      | Tipe Data | Keterangan      |
| ---------- | --------- | --------------- |
| id         | int (PK)  | Primary Key     |
| name       | varchar   | Nama ruangan    |
| capacity   | int       | Kapasitas       |
| facilities | text      | Fasilitas ruang |
| created_at | timestamp | waktu dibuat    |
| updated_at | timestamp | waktu update    |

Tabel reservations :
| Kolom      | Tipe Data | Keterangan           |
| ---------- | --------- | -------------------- |
| id         | int (PK)  | Primary Key          |
| user_id    | int (FK)  | Pemesan              |
| room_id    | int (FK)  | Ruangan              |
| date       | date      | Tanggal reservasi    |
| start_time | time      | Jam mulai            |
| end_time   | time      | Jam selesai          |
| status     | enum      | confirmed / canceled |
| created_at | timestamp | waktu dibuat         |
| updated_at | timestamp | waktu update         |

Relasi antar tabel :
- 1 User -> Banyak Reservasi (1:N)
- 1 Room -> Banyak Reservasi (1:N)

dan ada juga tabel bawaan dari laravel yaitu tabel :
- cache
- cache_locks
- failed_jobs
- jobs
- job_batches
- migrations
- password_reset_tokens
- sessions


2. Alur Logika Mencegah Konflik Jadwal
Konflik jadwal terjadi jika waktu mulai atau waktu selesai reservasi baru tumpang tindih dengan reservasi yang sudah ada sebelumnya

contoh :

| Reservasi Sistem | Reservasi Baru | Status          |
| ---------------- | -------------- | --------------- |
| 10:00–11:00      | 10:30–11:30    |   Bentrok       |
| 10:00–11:00      | 09:00–10:00    |   Tidak bentrok |
| 10:00–11:00      | 11:00–12:00    |   Tidak bentrok |
| 10:00–11:00      | 09:30–10:30    |   Bentrok       |


Berikut adalah program untuk sistem mencegah konflik jadwal :

$conflict = Reservation::where('room_id', $request->room_id)
->where(function ($query) use ($start, $end) {
	$query->where('start_time', '<', $end)
	->where('end_time', '>', $start);
})
->exists();

if ($conflict) {
	return back()->withErrors(['msg' => 'Ruangan sudah dipesan pada waktu tersebut.'])->withInput();
}


3. Dokumentasi cara prompt AI
selama pembuatan projek ini, saya menggunakan beberapa AI untuk membantu, yaitu :
- chat gpt => untuk membantu menganalisis dan program backend
- gemini => untuk membantu menganalisis dan program backend
- claude => untuk membantu membuat tampilan projek/bagian frontend
- Amazon => untuk membantu memperbaiki program yang sulit untuk di selesaikan

Berikut adalah perintah/prompt yang saya gunakan untuk AI :
chat gpt :
dari data yang sudah saya berikan, tolong buatkan rancangan dasar untuk memulai projek tersebut. buatkan rancangannya dengan jelas,baik dan benar

gemini  :
dari data yang sudah saya berikan, tolong analisis dan buatkan programnya dasar bagian backend nya

claude :
dari program yang sudah saya berikan, tolong buatkan tampilan halaman/frontend nya di laravel juga dan buatkan secara tersambung dengan backend nya

amazon :
perbaiki error dan warning yang ada di bagian admin dikarenakan di bagian tersebut sulit untuk saya perbaiki
