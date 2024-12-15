@foreach ($dataDataPelanggaran as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->kelas->nama_kelas}} </td>
      <td>{{ $item->siswa->nama_lengkap}} </td>
      <td>{{ $item->pelanggaran->jenis_pelanggaran}} </td>
      <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
      <td>{{ $item->subtotal_poin}} </td>
      <td>{{ $item->total_poin}} </td>
      <td>{{ $item->sanksipelanggaran->bentuk_sanksi}} </td>
      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('kesiswaan_datapelanggaran_edit', ['uuid' => $item->uuid]) }} ">
              <i class="fas fa-pencil-alt"></i>
          </a>
          <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
              <i class="fas fa-trash-alt"></i>
          </button>
      </td>
    </tr>
@endforeach

<tr>
   <td colspan="7" class="text-center">
       {{ $dataDataPelanggaran->links() }}
   </td>
</tr>
