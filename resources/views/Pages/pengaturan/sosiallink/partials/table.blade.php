@foreach ($dataSosialLink as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ $item->facebook }}" target="_blank">{{ $item->facebook }}</a> </td>
        <td><a href="{{ $item->linkedin }}" target="_blank">{{ $item->linkedin }}</a> </td>
        <td><a href="{{ $item->twitter }}" target="_blank">{{ $item->twitter }}</a> </td>
        <td><a href="{{ $item->google }}" target="_blank">{{ $item->google }}</a> </td>
        <td style="width: 150px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('pengaturan_sosiallink_edit', ['uuid' => $item->uuid]) }} ">
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
   {{ $dataSosialLink->links() }}
</div>