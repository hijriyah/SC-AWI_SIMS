@foreach ($dataUploadArsip as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->kategoriarsip->kategori_arsip }} </td>
        <td>{{ $item->judul }} </td>
        <td>{{ $item->file }} </td>
        <td>{{ $item->guru->nama_lengkap }} </td>

        <td style="width: 100px">
            <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} "
                target="_blank">
                <i class="fas fa-file-alt"></i>
            </a>
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('guru_arsipguru_uploadarsip_edit', ['uuid' => $item->uuid]) }} ">
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
    {{ $dataUploadArsip->links() }}
</div>
