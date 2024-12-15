@foreach ($dataJadwalUjian as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->rencanaujian->rencana_ujian }} </td>
    <td>{{ $item->kelas->nama_kelas }} </td>
    <td>{{ $item->section->section }} </td>
    <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
    <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
    <td>{{ $item->tanggal_ujian }} </td>
    <td>{{ $item->ujian_dari }} </td>
    <td>{{ $item->ujian_untuk }} </td>
    <td>{{ $item->ruangan }} </td>
    <td style="width: 100px">
        <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('ujian_jadwalujian_edit', ['uuid' => $item->uuid]) }} ">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
   {{ $dataJadwalUjian->links() }}
</div>