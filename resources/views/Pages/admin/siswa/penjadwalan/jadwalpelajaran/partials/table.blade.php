@foreach ($dataJadwalPelajaran as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><span
                style="background-color: {{ $item->guru->warna }}; padding: 5px; color: black;">{{ $item->guru->nama_lengkap }}</span>
        </td>
        <td>{{ $item->kelas->nama_kelas }} </td>
        <td>{{ $item->matapelajaran->mata_pelajaran }} </td>
        <td>{{ $item->waktu_mulai }}</td>
        <td>{{ $item->waktu_selesai }}</td>
        {{-- <td style="width: 150px">
         <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('penjadwalan_jadwalpelajaran_edit', ['uuid' => $item->uuid]) }} ">
              <i class="fas fa-pencil-alt"></i>
          </a>
          <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
              <i class="fas fa-trash-alt"></i>
          </button>
      </td> --}}
    </tr>
@endforeach

<div class="d-flex justify-content-start">
    {{ $dataJadwalPelajaran->links() }}
</div>