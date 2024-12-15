@foreach ($dataPemetaanTahsin as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->kelas->nama_kelas}} </td>
      <td>{{ $item->siswa->nama_lengkap}} </td>
      <td>{{ $item->kategoritahsin->kategori_tahsin}} </td>
      <td>{{ $item->guru->nama_lengkap}} </td>
      <td>{{ $item->tahunajaran->tahun_ajaran}} </td>
      <td>{{ $item->semester}} </td>
      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('alquran_tahsin_pemetaantahsin_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataPemetaanTahsin->links() }}
   </td>
</tr>
