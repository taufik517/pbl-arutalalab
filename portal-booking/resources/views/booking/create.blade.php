<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Membuat Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        body {
            background: #f6f8fa;
        }
        main.container {
            margin-top: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            max-width: 520px;
        }
        h1 {
            color: #2563eb;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        label {
            margin-top: 1rem;
            font-weight: 500;
        }
        input[type="number"], input[type="text"], input[type="datetime-local"] {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            padding: 0.7rem;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        button[type="submit"] {
            background: #2563eb;
            color: #fff;
            border-radius: 6px;
            padding: 0.7rem 1.5rem;
            font-size: 1.1rem;
            margin-top: 1.2rem;
            width: 100%;
            transition: background 0.2s;
            border: none;
        }
        button[type="submit"]:hover {
            background: #1e40af;
        }
        @media (max-width: 600px) {
            main.container {
                padding: 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>Membuat Booking Ruang Rapat</h1>
        @if($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Silakan isi form berikut untuk membuat booking ruang rapat.</p>
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <label for="user_id">ID User:</label>
            <input type="number" id="user_id" name="user_id" value="{{ old('user_id') }}" required placeholder="Masukkan ID User">

            <label for="room_id">Pilih Ruang:</label>
            <select id="room_id" name="room_id" required>
                <option value="">-- Pilih Ruang --</option>
                @if(!empty($rooms) && count($rooms) > 0)
                    @foreach($rooms as $room)
                        <option value="{{ $room['id'] }}" {{ old('room_id') == $room['id'] ? 'selected' : '' }}>{{ $room['name'] }} ({{ $room['capacity'] }} orang)</option>
                    @endforeach
                @else
                    <option value="">Tidak ada ruang tersedia</option>
                @endif
            </select>
            <label for="title">Judul Pemesanan:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Judul Booking">

            <label for="start_time">Waktu Mulai:</label>
            <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}" required>

            <label for="end_time">Waktu Selesai:</label>
            <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}" required>

            <button type="submit">Buat Pemesanan</button>
        </form>
    </main>
</body>
</html>