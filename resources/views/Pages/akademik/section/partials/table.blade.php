@foreach ($dataSection as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->section }}</td>
        <td>{{ $item->kategori }}</td>
        <td>{{ $item->kapasitas }}</td>
        <td>{{ $item->kelas->nama_kelas }}</td>
        <td>{{ $item->guru->nama_lengkap }}</td>
        <td>{{ $item->catatan }}</td>
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href="{{ route('akademik_section_edit', ['uuid' => $item->uuid]) }}">
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
       {{ $dataSection->links() }}
   </td>
</tr>
