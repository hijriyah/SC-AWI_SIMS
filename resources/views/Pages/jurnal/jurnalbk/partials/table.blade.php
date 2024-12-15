@foreach ($dataJurnalBK as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
      <td>{{ $item->semester}} </td>
      <td>{{ $item->bulan}} </td>
      <td>{{ $item->kelas->nama_kelas}} </td>
      <td>{{ $item->tanggal_kegiatan}} </td>
      <td>{{ $item->sasaran_kegiatan}} </td>
      <td>{{ $item->bimbingankonseling->jenis_konseling}} </td>
      <td>{{ $item->hasil_capai}} </td>

      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('jurnal_jurnalbk_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataJurnalBK->links() }}
   </td>
</tr>
