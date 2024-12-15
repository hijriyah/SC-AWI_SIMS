@foreach ($dataBimbinganKonseling as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
        <td>{{ $item->jenis_konseling }}</td>
        <td>{{ $item->deskripsi }}</td>

        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href="{{ route('bk_bimbingankonseling_edit', ['uuid' => $item->uuid]) }}">
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
       {{ $dataBimbinganKonseling->links() }}
   </td>
</tr>
