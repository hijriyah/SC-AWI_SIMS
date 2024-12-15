@foreach ($dataJurnalKelas as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->tanggal }} </td>
        <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
        <td>{{ $item->tahunajaran->tahun_ajaran }} </td>
        <td>{{ $item->materi_ajar }} </td>
        <td>{{ $item->siswa_hadir }} </td>
        <td>{{ $item->siswa_tidak_hadir }} </td>
        <td>{{ $item->tanda_tangan }} </td>
        <td style="width: 100px">
            <a class="btn btn-outline-danger btn-sm" title="Export To Pdf"
                href="{{ route('jurnal_jurnalkelas_download', ['id' => $item->id]) }}">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a class="btn btn-outline-info btn-sm edit" title="Edit"
                href=" {{ route('jurnal_jurnalkelas_edit', ['uuid' => $item->uuid]) }} ">
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
    {{ $dataJurnalKelas->links() }}
</div>