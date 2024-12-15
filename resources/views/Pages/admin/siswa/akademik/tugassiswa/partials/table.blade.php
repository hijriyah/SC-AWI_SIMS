@foreach ($dataTugasSiswa as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->judul }} </td>
    <td>{{ $item->deskripsi }} </td>
    <td>{{ $item->deadline }} </td>
    <td>{{ $item->kelas->nama_kelas }} </td>
    <td>{{ $item->tahunajaran->tahun_ajaran }} </td>
    <td>{{ $item->section->section}} </td>
    <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
    <td style="width: 150px">
        <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} " target="_blank">
            <i class="fas fa-file-alt"></i>
        </a>
        <a class="btn btn-outline-success btn-sm edit" title="answer" href="{{ route('siswa_akademik-tugassiswa_add') }}">
            <i class="fas fa-comment"></i>
        </a>
        @if($item->jawaban != null)
            <a class="btn btn-outline-info btn-sm edit" title="edit" href="{{ route('siswa_akademik-tugassiswa_edit') }}">
                <i class="fas fa-pencil-alt"></i>
            </a>
        @endif
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataTugasSiswa->links() }}
</div>