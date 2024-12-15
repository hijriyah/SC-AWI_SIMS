@foreach ($dataBarangMasuk as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->nama_barang_masuk}} </td>
      <td>{{ $item->serial}} </td>
      <td>{{ $item->deskripsi}} </td>
      <td>{{ $item->manufaktur}} </td>
      <td>{{ $item->brand}} </td>
      <td>{{ $item->nomor_barang}} </td>
      <td>{{ $item->tanggal_masuk}} </td>
      <td>{{ $item->jumlah_masuk}} </td>
      <td>{{ $item->status}} </td>
      <td>{{ $item->kondisi_barang}} </td>
      <!--<td>{{ $item->lampiran}} </td> -->
      <td>{{ $item->kategoribarang->kategori_barang}} </td>
      <td>{{ $item->lokasibarang->lokasi_barang}} </td>
      
      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('inventaris_barangmasuk_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataBarangMasuk->links() }}
   </td>
</tr>
