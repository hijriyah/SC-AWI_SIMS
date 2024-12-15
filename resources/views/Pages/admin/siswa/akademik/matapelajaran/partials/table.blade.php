@foreach ($dataMataPelajaran as $item)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->tipe_mata_pelajaran}} </td>
    <td>{{ $item->mata_pelajaran}} </td>
    <td>{{ $item->kode_mata_pelajaran}} </td>
    <td><span style="background-color: {{ $item->guru->warna }}; padding: 5px;">{{ $item->guru->nama_lengkap }}</span> </td>

        {{-- <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('akademik_matapelajaran_edit', ['uuid' => $item->uuid]) }} ">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td> --}}
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataMataPelajaran->links() }}
</div>