@foreach ($dataEvent as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>{{ $item->tanggal_mulai }} </td>
        <td>{{ $item->tanggal_selesai }} </td>
        <td>{{ $item->waktu_mulai }} </td>
        <td>{{ $item->waktu_selesai }} </td>
        <td>{{ $item->judul }} </td>
        <td>{{ $item->deskripsi }} </td>
        <td><img src="{{ $item->file }}" style="width: 50px; height: 50px;" /></td>
        <td>{{ $item->status }} </td>
        {{-- <td style="width: 150px">
                                            <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} " target="_blank">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                            <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('pemberitahuan_event_edit', ['uuid' => $item->uuid]) }} ">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td--}}>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataEvent->links() }}
</div>
