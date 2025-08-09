<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <style>
        body {
            background: #f6f8fa;
        }
        main.container {
            margin-top: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            padding: 2rem 2.5rem;
        }
        h1 {
            color: #2563eb;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        a[role="button"] {
            background: #2563eb;
            color: #fff !important;
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            margin-bottom: 1rem;
            display: inline-block;
            transition: background 0.2s;
        }
        a[role="button"]:hover {
            background: #1e40af;
        }
        table {
            margin-top: 1.5rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        th {
            background: #2563eb;
            color: #fff;
            font-weight: 600;
        }
        td, th {
            text-align: center;
            padding: 0.75rem 0.5rem;
        }
        tr:nth-child(even) {
            background: #f1f5f9;
        }
    </style>
</head>
<body>
     <main class="container"> 

        <h1>Daftar Booking Ruang Rapat</h1>
        <p>Berikut adalah daftar booking ruang rapat yang telah dilakukan.</p>
        <a href="{{ route('booking.create') }}" role="button">Buat Booking Baru</a>

        <figure> 
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th scope="col">ID User</th>
                    <th scope="col">ID Ruang</th>
                    <th scope="col">Nama Booking</th>
                    <th scope="col">Waktu Mulai</th>
                    <th scope="col">Waktu Selesai</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($booking as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ is_numeric($booking->user_id) ? $booking->user_id : '-' }}</td>
                    <td>{{ is_numeric($booking->room_id) ? $booking->room_id : '-' }}</td>
                    <td>{{ $booking->title }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td class="actions">
                        <form action="{{ route('booking.edit', $booking) }}" method="GET" style="display:inline;">
                            <button type="submit" class="button">Edit</button>
                        </form>
                        <form action="{{ route('booking.destroy', $booking) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" secondary outline="">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak ada booking yang ditemukan.</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        </figure>
    </main>
</body>
</html>