@foreach ($dataRole as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }} </td>
        <td style="width: 150px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('pengaturan_role_edit', ['id' => $item->id]) }} ">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button"
                data-id="{{ $item->id }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
   {{ $dataRole->links() }}
</div>