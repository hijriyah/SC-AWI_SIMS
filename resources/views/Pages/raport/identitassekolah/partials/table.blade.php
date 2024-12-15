@foreach ($dataIdentitasSekolah as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->nama_sekolah }} </td>
    <td>{{ $item->alamat }} </td>
    <td>{{ $item->kabupaten }} </td>
    <td>{{ $item->provinsi }} </td>
    <!-- <td>{{ $item->file}} </td> --> <!-- logo sekolah -->
    <td>{{ $item->nama_kepala_sekolah }} </td>
    <td>{{ $item->nip_kepala_sekolah }} </td>
    

    <td style="width: 150px">
        <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} " target="_blank">
            <i class="fas fa-file-alt"></i>
        </a>
        <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('raport_identitassekolah_edit', ['uuid' => $item->uuid]) }} ">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
   {{ $dataIdentitasSekolah->links() }}
</div>
