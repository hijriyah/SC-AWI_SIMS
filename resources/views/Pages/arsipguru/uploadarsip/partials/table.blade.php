@foreach ($dataUploadArsip as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->kategoriarsip->kategori_arsip}} </td>
      <td>{{ $item->judul}} </td>
      <td>{{ $item->file}} </td>
      <td>{{ $item->guru->nama_lengkap}} </td>
      
      <td style="width: 100px">
          <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('arsipguru-uploadarsip_edit', ['uuid' => $item->uuid]) }} ">
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
       {{ $dataUploadArsip->links() }}
   </td>
</tr>
