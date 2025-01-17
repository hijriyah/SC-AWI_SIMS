@foreach ($dataOrangtua as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        @if ($item->photo)
            <td><img src="{{ $item->photo }}" width="50" height="50" /></td>
        @else
            <td><span class="badge badge-soft-danger">Tidak Ada</span></td>
        @endif
        <td>{{ $item->nama_ayah }}</td>
        <td>{{ $item->nama_ibu }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->no_telp }}</td>
        @if ($item->aktif == 'ya')
            <td><span class="badge badge-soft-success">{{ $item->aktif }}</span></td>
        @else
            <td><span class="badge badge-soft-success">{{ $item->aktif }}</span></td>
        @endif
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('orangtua_master_edit', ['uuid' => $item->uuid]) }} ">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm edit delete-button" title="Delete"
                id="delete-button" data-uuid="{{ $item->uuid }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endforeach

<tr>
    <td colspan="7" class="text-center">
        {{ $dataOrangtua->links() }}
    </td>
</tr>
