<!DOCTYPE html>
<html>
<head>
    <title>Daftar Job</title>
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
                <th>Nama Pemesan & No. Antrian</th>
                <th>Tgl. Mulai</th>
                <th>Tgl. Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <tr>
                    <td width="5%" class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->order->name }} <b>({{ $item->order->order_number }})</b></td>
                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                    <td>
                        @switch($item->status)
                            @case('pending')
                                <span>Dalam Antrian</span>
                            @break

                            @case('completed')
                                <span>Selesai</span>
                            @break

                            @case('cancelled')
                                <span>Dibatalkan</span>
                            @break

                            @case('processing')
                                <span>Sedang Dikerjakan</span>
                            @break

                            @default
                        @endswitch
                    </td>
                </tr>
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
