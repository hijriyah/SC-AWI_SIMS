@foreach ($dataNilaiUmum as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->siswa->nama_lengkap}} </td>
      <td>{{ $item->matapelajaran->mata_pelajaran}} </td>
      <td>{{ $item->nilai_uas}} </td>
      <td>{{ $item->nilai_tugas}} </td>
      <td>{{ $item->nilai-uh}} </td>
      
      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('raport_nilaiumum_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataNilaiUmum->links() }}
   </td>
</tr>
