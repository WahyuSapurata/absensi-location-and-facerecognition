<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan {{ $startDateStr . ' Sampai ' . $endDateStr }}</title>
    <link rel="shortcut icon" href="/logo.png" />
</head>

<style>
    .title {
        font-size: 12px;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
            border-radius: 5px;
        }

        table thead {
            display: none;
        }

        table tr {
            margin-bottom: 10px;
            display: block;
            border: 1px solid #ddd;
        }

        table td {
            display: block;
            text-align: right;
            padding-left: 45%;
            position: relative;
        }

        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 45%;
            padding-left: 0;
            text-align: left;
            font-weight: bold;
        }
    }
</style>

<body>
    <div class="title">REKAP ABSEN GURU DAN STAF</div>
    <div class="title">{{ 'Tanggal ' . $startDateStr . ' Sampai ' . $endDateStr }}</div>

    <table style="border: 1px solid; width: 100%;">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NAMA</th>
                <th colspan="7">ABSENSI</th>
            </tr>
            <tr>
                <th>UNIT</th>
                <th>HADIR</th>
                <th>SAKIT</th>
                <th>IZIN</th>
                <th>TIDAK CEKLOK MASUK</th>
                <th>TIDAK CEKLOK PULANG</th>
                <th>REKAP GAJI</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($combinedData as $index => $rekap)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rekap->name }}</td>
                    <td>{{ $rekap->unit }}</td>
                    <td>{{ $rekap->jumlahHadir }}</td>
                    <td>{{ $rekap->jumlahIzin }}</td>
                    <td>{{ $rekap->jumlahSakit }}</td>
                    <td>{{ $rekap->jumlahTidakCeklokMasuk }}</td>
                    <td>{{ $rekap->jumlahTidakCeklokPulang }}</td>
                    <td>Rp. {{ number_format($rekap->gaji, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
