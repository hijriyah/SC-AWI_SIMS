@foreach ($dataNilaiRaport as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->siswa->nama_lengkap}} </td>
      <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
      <td>{{ $item->semester->semester}} </td>
      <td>{{ $item->matapelajaran->mata_pelajaran}} </td>
      <td>{{ $item->kkm}} </td>
      <td>{{ $item->nilai_akhir}} </td>
      <td>{{ $item->kkm->predikat}} </td>
      <td>{{ $item->rata_rata_permapel}} </td>
      <td>{{ $item->catatanwalikelas->catatan}} </td>

      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('raport_nilairaport_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataNilaiRaport->links() }}
   </td>
</tr>
