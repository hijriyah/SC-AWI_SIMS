@foreach ($dataBarangKeluar as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->barangmasuk->nama_barang_masuk}} </td>
      <td>{{ $item->jatuh_tempo}} </td>
      <td>{{ $item->catatan}} </td>
      <td>{{ $item->jumlah_keluar}} </td>
      <td>{{ $item->status}} </td>
      <td>{{ $item->lokasibarang->lokasi_barang}} </td>
      <td>{{ $item->tanggal_keluar}} </td>
      <td>{{ $item->tanggal_masuk}} </td>

      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('inventaris_barangkeluar_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataBarangKeluar->links() }}
   </td>
</tr>
