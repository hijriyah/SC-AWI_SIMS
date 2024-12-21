@foreach ($dataLiburan as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->tahunajaran->tahun_ajaran }} </td>
    <td>{{ $item->tanggal_mulai }} </td>
    <td>{{ $item->tanggal_selesai }} </td>
    <td>{{ $item->judul }} </td>
    <td>{{ $item->deskripsi }} </td>
    <td><img src="{{ $item->file }}" style="width: 50px; height: 50px;" /></td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataLiburan->links() }}
</div>