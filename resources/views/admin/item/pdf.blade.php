<!DOCTYPE html>
<html>
<head>
    <title>Daftar Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .header-content {
            flex-grow: 1;
            text-align: center;
            margin: 0 20px; /* Menambahkan margin untuk memberi ruang antara logo dan konten */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: auto; /* Memungkinkan tabel menyesuaikan lebarnya sesuai dengan konten */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left; /* Menyesuaikan teks ke kiri agar lebih rapi */
        }
        th {
            background-color: #f2f2f2; /* Menambahkan warna latar belakang pada header */
        }
        .signature {
            margin-top: 40px; /* Jarak antara tabel dan tanda tangan */
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://w7.pngwing.com/pngs/336/413/png-transparent-point-blank-garena-logo-nao%C2%A5m-television-text-logo-thumbnail.png" alt="Left Logo" class="float-left">
        <img src="https://w7.pngwing.com/pngs/336/413/png-transparent-point-blank-garena-logo-nao%C2%A5m-television-text-logo-thumbnail.png" alt="Right Logo" class="float-right">
        <div class="header-content">
            <h2>Punggawa Digital Printing</h2>
            <p>Jl. Sungai Saddang Baru No.37, Maradekaya Sel., Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222 | 0812-4444-4705</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                {{-- <th>Deskripsi</th> --}}
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Aktif</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>[
                    @for ($i = 0; $i < count(json_decode($item->sizes)); $i++)
                        {{ json_decode($item->sizes)[$i] }},
                    @endfor
                ]</td>
                <td>[
                    @for ($i = 0; $i < count(json_decode($item->prices)); $i++)
                        {{ json_decode($item->prices)[$i] }},
                    @endfor
                ]</td>
                <td>
                    @if ($item->is_active)
                        Ya
                    @else
                        Tidak
                    @endif
                </td>
                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p>_____________________________</p>
        <p>Tanda Tangan</p>
    </div>
</body>
</html>

