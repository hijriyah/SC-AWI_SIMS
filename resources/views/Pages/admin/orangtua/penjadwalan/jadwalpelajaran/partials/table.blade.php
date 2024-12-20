@foreach ($dataJadwalPelajaran as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><span
                style="background-color: {{ $item->guru->warna }}; padding: 5px; color: black;">{{ $item->guru->nama_lengkap }}</span>
        </td>
        <td>{{ $item->kelas->nama_kelas }} </td>
        <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
        <td>{{ $item->waktu_mulai }}</td>
        <td>{{ $item->waktu_selesai }}</td>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataJadwalPelajaran->links() }}
</div>
