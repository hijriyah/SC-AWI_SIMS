@foreach ($dataKelas as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_kelas }}</td>
        <td>{{ $item->kelas_angka }}</td>
        <td>{{ $item->guru->nama_lengkap}} </td>
        <td>{{ $item->maksimal_siswa }}</td>
        <td>{{ $item->catatan }}</td>
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href="{{ route('akademik_kelas_edit', ['uuid' => $item->uuid]) }}">
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
       {{ $dataKelas->links() }}
   </td>
</tr>
