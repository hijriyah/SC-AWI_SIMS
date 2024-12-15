@foreach ($dataOrangtua as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->nama_ayah }}</td>
        <td>{{ $item->nama_ibu }}</td>
        <td>{{ $item->pekerjaan_ayah }}</td>
        <td>{{ $item->pekerjaan_ibu }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->no_telp }}</td>
        <td>{{ $item->alamat }}</td>
        <!--<td>{{ $item->photo }}</td>-->
        <td>{{ $item->username }}</td>
        <td>{{ $item->password }}</td>
        <td>{{ $item->aktif }}</td>
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm edit" title="Edit" href="{{ route('orangtua_master_edit', ['uuid' => $item->uuid]) }}">
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
       {{ $dataOrangtua->links() }}
   </td>
</tr>
