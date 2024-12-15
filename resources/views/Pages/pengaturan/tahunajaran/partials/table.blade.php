@foreach ($dataTahunAjaran as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->tipe_sekolah }}</td>
        <td>{{ $item->tahun_ajaran }}</td>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->tanggal_mulai }}</td>
        <td>{{ $item->tanggal_selesai }}</td>
        <td>{{ $item->semester }}</td>

        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href="{{ route('pengaturan_tahunajaran_edit', ['uuid' => $item->uuid]) }}">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm edit delete-button" title="Delete" id="delete-button">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endforeach

<tr>
   <td colspan="7" class="text-center">
       {{ $dataTahunAjaran->links() }}
   </td>
</tr>
