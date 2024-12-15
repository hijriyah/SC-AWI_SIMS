<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurnal Kelas Report</title>
    <style>
        .center-content {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            line-height: 0.5;
            font-family: sans-serif;
        }

        .tb {
            display: flex;
            justify-content: center;
        }

        .styled-table {
            border-collapse: collapse; 
            width: 100%; 
            border: 1px solid #ddd; 
            font-size: 12px;
        }

        .styled-table th, .styled-table td {
            border: 1px solid #ddd;
            padding: 8px; 
            text-align: left; 
            font-family: sans-serif;
        }

        .styled-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-family: sans-serif;
        }

        .styled-table tr:nth-child(even) {
            background-color: #f9f9f9; 
        }

        .styled-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="center-content">
        <p>JURNAL HARIAN KELAS</p>
        <p>SMP ISLAM TERPADU USTMAN BIN AFFAN SURABAYA</p>
        <p>TAHUN PELAJARAN {{ $data->tahunajaran->tahun_ajaran }}</p>
    </div>

    <div class="start-content">
        <p>Hari/Tanggal: <span style="margin-left: 30px;">{{ $data->tanggal }}</span></p>
    </div>

    <div class="tb">
        <table class="styled-table">
            <tr>
                <th>JAM KE</th>
                <th>JAM MULAI</th>
                <th>JAM SELESAI</th>
                <th>MAPEL</th>
                <th>GURU MAPEL</th>
                <th>MATERI AJAR</th>
                <th>SISWA HADIR</th>
                <th>SISWA TIDAK HADIR</th>
                <th>STATUS</th>
            </tr>
            <tr>
                <td>{{ $data->jam }}</td>
                <td>{{ $data->jam_mulai }}</td>
                <td>{{ $data->jam_selesai }}</td>
                <td>{{ $data->matapelajaran->mata_pelajaran }}</td>
                <td>{{ $data->matapelajaran->guru->nama_lengkap }}</td>
                <td>{{ $data->materi_ajar }}</td>
                <td>{{ $data->siswa_hadir }}</td>
                <td>{{ $data->siswa_tidak_hadir }}</td>
                <td>{{ $data->status }}</td>
            </tr>
        </table>
    </div>

</body>
</html>