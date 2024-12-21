@foreach ($dataRencanaKegiatan as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->nama_kegiatan}} </td>
    <td>{{ $item->tanggal_mulai }} </td>
    <td>{{ $item->waktu_mulai }} </td>
    <td>{{ $item->lokasi_kegiatan }} </td>
    <td><img src="{{ $item->file}}" style="width: 50px; height: 50px;" /> </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataRencanaKegiatan->links() }}
</div>