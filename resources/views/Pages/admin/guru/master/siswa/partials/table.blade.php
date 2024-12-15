@foreach ($dataSiswa as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_lengkap }} </td>
        <td>{{ $item->tanggal_masuk }} </td>
        <td>{{ $item->jenis_kelamin }} </td>
        <td>{{ $item->agama }} </td>
        <td>{{ $item->aktif }}</td>
        <td style="width: 100px">
            <a class="btn btn-outline-info btn-sm info" title="Info"
                href=" {{ route('guru_siswamaster_info', ['uuid' => $item->uuid]) }} ">
                <i class="fas fa-info-circle"></i>
            </a>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataSiswa->links() }}
</div>