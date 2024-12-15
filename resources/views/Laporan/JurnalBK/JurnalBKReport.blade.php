<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurnal BK Report</title>
    <style>
        .text-center {
            text-align: center;
            font-weight: bold;
            color: black;
            line-height: 0.5;
            font-size: 20px;
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
            font-size: 16px;
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
    <div class="text-center">
        <p>JURNAL HARIAN KEGIATAN BIMBINGAN DAN KONSELING</p>
        <p>SEMESTER({{ $data->semester }}), BULAN: {{ $data->bulan  }}</p>
        <p>TAHUN PELAJARAN {{ $data->tahunajaran->tahun_ajaran }}</p>
    </div>

    <div class="content-one">
        <p>Kelas:  <span style="margin-left: 50px; display: inline;">{{ $data->kelas->nama_kelas }}</span></p>       
        <p>minggu: <span style="margin-left: 50px; display: inline;">{{ $data->minggu_ke }}</span></p>
    </div>

    <div class="tb">
        <table class="styled-table">
            <tr>
                <th>No</th>
                <th>Tanggal Sasaran</th>
                <th>Sasaran Kegiatan</th>
                <th>Bimbingan Konseling</th>
                <th>Hasil Capai</th>
            </tr>
            <tr>
                <td>-</td>
                <td>{{ $data->tanggal_kegiatan }}</td>
                <td>{{ $data->sasaran_kegiatan }}</td>
                <td>{{ $data->bimbingankonseling->jenis_konseling }}</td>
                <td>{{ $data->hasil_capai }}</td>
            </tr>
        </table>
    </div>

</body>
</html>