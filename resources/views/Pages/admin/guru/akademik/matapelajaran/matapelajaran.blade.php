@extends('layouts.layout')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Selamat Datang Di {{ $adminSession }} Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<script>

    function SearchData()
    {
        var search = $('#search').val();

        $.ajax({
            url: "{{ route('guru_akademik_matapelajaran_page') }}",
            type: "GET",
            data: { search: search},
            success: function(response) {
                $('#table-body').html(response.html);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    document.addEventListener('DOMContentLoaded', () => {
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var uuid = $(this).data('uuid');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tetap Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/guru/dashboard/akademik/matapelajaran/delete/" + uuid,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan, data tidak dapat dihapus.',
                                'error'
                            );
                            console.log(error);
                        }
                    });
                }
            });
        });
    })
    



</script>

<div class="row" style="margin-top: 0px; margin-bottom: 500px;">

    <!-- start page title -->
    <!--<div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
            </div>
        </div>
    </div>-->
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="display-position" style="margin-bottom: 20px;">
                        <div class="d-flex justify-content-between">
                            <div style="margin-top: 0px;">
                                <h4 class="card-title" style="width: 200px;"><b>Daftar Mata Pelajaran</b></h4>
                            </div>
                            <div class="col-md-3" style="margin-left: 600px; margin-right: 10px;">
                                <input class="form-control" placeholder="Search" style="height: 32px;" id="search" name="search" onkeyup="SearchData()" />     
                            </div> 
                            <div style="margin-top: 0px; width: 100px;">
                                <a class="btn btn-sm btn-success" href="{{ route('guru_akademik_matapelajaran_add') }}"><i class="mdi mdi-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipe Mata Pelajaran</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kode Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($dataMataPelajaran as $item)
                                    <tr>
                                       <td>{{ $loop->iteration }}</td>
                                       <td>{{ $item->tipe_mata_pelajaran}} </td>
                                       <td>{{ $item->mata_pelajaran}} </td>
                                       <td>{{ $item->kode_mata_pelajaran}} </td>
                                       {{-- <td><span style="background-color: {{ $item->guru->warna }}; padding: 5px;">{{ $item->guru->nama_lengkap }}</span> </td> --}}
      
                                        <td style="width: 100px">
                                            <a class="btn btn-outline-info btn-sm edit" title="Edit" href=" {{ route('akademik_matapelajaran_edit', ['uuid' => $item->uuid]) }} ">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Delete" id="delete-button" data-uuid="{{ $item->uuid }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-start">
                        {{ $dataMataPelajaran->links() }}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<!-- End Page-content -->

</div>
<!-- end row -->



@endsection