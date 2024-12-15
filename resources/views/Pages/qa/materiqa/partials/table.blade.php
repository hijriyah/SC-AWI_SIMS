@foreach ($dataMateriQa as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->tahunajaran->tahun_ajaran }} </td>
    <td>{{ $item->kelas->nama_kelas }} </td>
    <td>{{ $item->materi }} </td>
    <td>{{ $item->kompetensi }} </td>
    <!-- <td>{{ $item->file }} </td> -->

    <td style="width: 150px">
        <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} " target="_blank">
            <i class="fas fa-file-alt"></i>
        </a>
        <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('qa_materiqa_edit', ['uuid' => $item->uuid]) }} ">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
   {{ $dataMateriQa->links() }}
</div>
