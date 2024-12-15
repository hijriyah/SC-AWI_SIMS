@foreach ($dataGuru as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_lengkap }} </td>
        <td>{{ $item->tanggal_bergabung }} </td>
        <td>{{ $item->jenis_kelamin }} </td>
        <td>{{ $item->agama }} </td>
        @if ($item->aktif == 'ya')
            <td><span class="badge text-bg-success">{{ $item->aktif }}</span></td>
        @else
            <td><span class="badge text-bg-danger">{{ $item->aktif }}</span></td>
        @endif
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm info" title="Info"
                href=" {{ route('guru_gurumaster_info', ['uuid' => $item->uuid]) }} ">
                <i class="fas fa-info-circle"></i>
            </a>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataGuru->links() }}
</div>
