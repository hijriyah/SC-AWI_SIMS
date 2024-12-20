@foreach ($dataEbooks as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td><img style="width: 50px; height: 50px;" src="{{ '/storage/' . $item->coverfoto }}"/> </td>
    <td>{{ $item->judul }} </td>
    <td>{{ $item->author }} </td>
    <td>{{ $item->kelas->nama_kelas }} </td>
    <td>{{ $item->authority }} </td>
    <td style="width: 150px">
        <a class="btn btn-outline-warning btn-sm edit" title="preview" href="{{ '/storage/' . $item->file }} " target="_blank">
            <i class="fas fa-file-alt"></i>
        </a>
    </td>
</tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataEbooks->links() }}
</div>