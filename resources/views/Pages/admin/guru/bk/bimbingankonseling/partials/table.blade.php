@foreach ($dataBimbinganKonseling as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->jenis_konseling }} </td>
    <td>{{ $item->deskripsi }} </td>
    <td style="width: 100px">
        <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('guru_bk-bimbingankonseling_edit', ['uuid' => $item->uuid]) }} ">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataBimbinganKonseling->links() }}
</div>