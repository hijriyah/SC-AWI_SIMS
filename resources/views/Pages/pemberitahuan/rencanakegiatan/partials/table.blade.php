@foreach ($dataRencanaKegiatan as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
        <td>{{ $item->nama_kegiatan }} </td>
        <td>{{ $item->deskripsi }} </td>
        <td>{{ $item->tanggal_mulai }} </td>
        <td>{{ $item->tanggal_selesai }} </td>
        <td>{{ $item->waktu_mulai }} </td>
        <td>{{ $item->waktu_selesai }} </td>
        <td>{{ $item->lokasi_kegiatan }} </td>
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('pemberitahuan_rencanakegiatan_edit', ['uuid' => $item->uuid]) }} ">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button"
                data-uuid="{{ $item->uuid }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
   {{ $dataRencanaKegiatan->links() }}
</div>
