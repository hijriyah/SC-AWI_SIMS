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
        <p>JURNAL KESISWAAN</p>
        <p>SMP IT USTMAN BIN AFFAN SURABAYA</p>
    </div>

    <div class="tb">
        <table class="styled-table">
            <tr>
                <th>NO</th>
                <th>PROGRAM</th>
                <th>WAKTU REALISASI</th>
                <th>EVALUASI</th>
            </tr>
            <tr>
                <td>-</td>
                <td>{{ $data->program}}</td>
                <td>{{ $data->waktu_realisasi }}</td>
                <td>{{ $data->evaluasi }}</td>
            </tr>
        </table>
    </div>

</body>
</html>