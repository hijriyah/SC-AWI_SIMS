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

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif


        $(function() {
            $('#jstree').jstree();
            $('#jstree').on("changed.jstree", function(e, data) {
                console.log(data.selected);
            });
            // $('button').on('click', function() {
            //     $('#jstree').jstree(true).select_node('child_node_1');
            //     $('#jstree').jstree('select_node', 'child_node_1');
            //     $.jstree.reference('#jstree').select_node('child_node_1');
            // });
        });
        
        // $(document).ready(function () {
        //     console.log($('.pdf-file-icon .jstree-icon').length);
        // });
        
        function AddParent() {
            $('.modalContent').append(
                `<div class="modal fade" id="AddParentFolder" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                <form action="{{ route('pemberitahuan_gkmediaparent_store') }} " method="POST">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="AddParent">Tambah Galeri Kegiatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Folder</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" />
                                        @error('nama')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        `
            );
            $('#AddParentFolder').modal('show');
        };

        function EditParent(uuid) {
            $.ajax({
                url: '/administrator/dashboard/pemberitahuan/gkmediaparent/edit/' + uuid,
                type: 'GET',
                success: (response) => {
                    $('.modal').remove();
                    const Url = '/administrator/dashboard/pemberitahuan/gkmediaparent/update/' + uuid;

                    $('.modalContent').append(
                        `<div class="modal fade" id="EditParentFolder" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                        <form action="${Url}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="AddParent">Edit Nama</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="${response.data.nama}" />
                                                @error('nama')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                `
                    );
                    $('#EditParentFolder').modal('show');

                }
            });
        }

        function DestroyParent(uuid) {
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
                        url: "/administrator/dashboard/pemberitahuan/gkmediaparent/delete/" + uuid,
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
        }


        function AddMediaSub1(id_gkmediaparent)
        {
            let Url = '/administrator/dashboard/pemberitahuan/gkmediasubf1/store/' + id_gkmediaparent;
            $('.modalContent').append(
                `<div class="modal fade" id="AddSubF1Folder" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                <form action="${Url}" method="POST">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="AddParent">Tambah Galeri Kegiatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Folder</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" />
                                        @error('nama')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        `
            );
            $('#AddSubF1Folder').modal('show');
        }

        function EditMediaSubF1(uuid, id_gkmediaparent)
        {
            $.ajax({
                url: '/administrator/dashboard/pemberitahuan/gkmediasubf1/edit/' + uuid,
                type: 'GET',
                success: (response) => {
                    $('.modal').remove();
                    const Url = '/administrator/dashboard/pemberitahuan/gkmediasubf1/update/' + uuid + '/' + id_gkmediaparent;

                    $('.modalContent').append(
                        `<div class="modal fade" id="EditSubFolder1" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                        <form action="${Url}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="AddParent">Edit Nama</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="${response.data.nama}" />
                                                @error('nama')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                `
                    );
                    $('#EditSubFolder1').modal('show');

                }
            });
        }

        function DestroyMediaSubF1(uuid) {
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
                        url: "/administrator/dashboard/pemberitahuan/gkmediasubf1/delete/" + uuid,
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
        }

        function AddMediaSub2(id_gkmediasubf1)
        {
            let Url = '/administrator/dashboard/pemberitahuan/gkmediasubf2/store/' + id_gkmediasubf1;
            $('.modalContent').append(
                `<div class="modal fade" id="AddSubF2Folder" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                <form action="${Url}" method="POST">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="AddParent">Tambah Galeri Kegiatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Folder</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" />
                                        @error('nama')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        `
            );
            $('#AddSubF2Folder').modal('show');
        }

        function EditMediaSubF2(uuid, id_gkmediasubf1)
        {
            $.ajax({
                url: '/administrator/dashboard/pemberitahuan/gkmediasubf2/edit/' + uuid,
                type: 'GET',
                success: (response) => {
                    $('.modal').remove();
                    const Url = '/administrator/dashboard/pemberitahuan/gkmediasubf2/update/' + uuid + '/' + id_mediaSubF1;

                    $('.modalContent').append(
                        `<div class="modal fade" id="EditSubFolder2" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                        <form action="${Url}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="AddParent">Edit Nama</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="${response.data.nama}" />
                                                @error('nama')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                `
                    );
                    $('#EditSubFolder2').modal('show');

                }
            });
        }

        function DestroyMediaSubF2(uuid) {
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
                        url: "/administrator/dashboard/pemberitahuan/gkmediasubf2/delete/" + uuid,
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
        }

        function AddMediaFile(id_gkmediasubf2)
        {

            $('.modalContent').append(
                `<div class="modal fade" id="AddMediaFile" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                <form enctype="multipart/form-data" id="AddMediaFileForm">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="AddParent">Tambah File</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" />
                                        @error('nama')
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">File</label>
                                        <input type="file" 
                                        id="filepond"
                                        class="filepond"
                                        name="filepond[]" 
                                        data-allow-reorder="true"
                                        data-max-file-size="2MB"
                                        data-max-files="2" />

                                        @error('filepond')
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>`
            );
            $('#AddMediaFile').modal('show');

            const inputElement = document.querySelector('#filepond');
            const pond = FilePond.create(inputElement);

            FilePond.setOptions({
                server: {
                    process: {
                        url: '/administrator/dashboard/pemberitahuan/gkmediafile/store/' + id_gkmediasubf2,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        onload: (response) => {
                            console.log(response);
                        },
                        onerror: (response) => {
                            console.log(response);
                        },
                    },
                },
            });


            let Url = '/administrator/dashboard/pemberitahuan/gkmediafile/store/' + id_mediaSubF2;
            $('#AddMediaFileForm').on('submit', function (e) {
                e.preventDefault();  

                var formData = new FormData(this);

                pond.getFiles().forEach(function(file) {
                    formData.append('filepond[]', file.file);
                });
                

                $.ajax({
                    url: Url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        toastr.success('data berhasil disimpan');
                        setTimeout(() => {
                            window.location.href = "{{ route('pemberitahuan_gkmediaparent_page') }}"; 
                        }, 2000);
                    },
                    error: function (response) {
                        toastr.error('data gagal disimpan');
                    }
                });
            });
        }

        function EditMediaFile(uuid, id_gkmediasubf2)
        {
            $.ajax({
                url: '/administrator/dashboard/pemberitahuan/gkmediafile/edit/' + uuid,
                type: 'GET',
                success: (response) => {
                    $('.modal').remove();

                    $('.modalContent').append(
                        `<div class="modal fade" id="EditMediaFile" tabindex="-1" aria-labelledby="AddParent" aria-hidden="true">
                        <form id="EditMediaFileForm" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="AddParent">Edit File</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                         <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="${response.data.nama}" />
                                        @error('nama')
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">File</label>
                                        <input type="file" 
                                        id="filepond"
                                        class="filepond"
                                        name="filepond[]" 
                                        data-allow-reorder="true"
                                        data-max-file-size="2MB"
                                        data-max-files="2" />

                                        @error('filepond')
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-telegram"></i> Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                `
                    );
                    $('#EditMediaFile').modal('show');

                    const inputElement = document.querySelector('#filepond');
                    const pond = FilePond.create(inputElement, {
                        allowFileSizeValidation: true,
                        maxFileSize: '2MB'
                    });

                    FilePond.setOptions({
                        server: {
                            process: {
                                url: '/administrator/dashboard/pemberitahuan/gkmediafile/update/' + uuid + '/' + id_mediaSubF2,
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                onload: (response) => {
                                    console.log(response);
                                },
                                onerror: (response) => {
                                    console.log(response);
                                },
                            },
                        },
                    });


                    let Url= '/administrator/dashboard/pemberitahuan/gkmediafile/update/' + uuid + '/' + id_mediaSubF2;
                    let fileData = null;

                    $.ajax({
                        url: "/storage/" + response.data.file,
                        type: 'GET',
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(blob) {
                            const FileName = response.data.file.split('/').pop();
                            const fileData = new File([blob], FileName, { 
                                type: 'application/pdf',
                                size: blob.size,
                            });
                            pond.addFiles(fileData);

                            $('#EditMediaFileForm').on('submit', function (e) {
                                e.preventDefault();  

                                var formData = new FormData(this);

                                pond.getFiles().forEach(function(file) {
                                    formData.append('filepond[]', file.file);
                                });
                    
                                $.ajax({
                                    url: Url,
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        toastr.success('data berhasil disimpan');
                                        setTimeout(() => {
                                            window.location.href = "{{ route('pemberitahuan_gkmediaparent_page') }}"; 
                                        }, 2000);
                                    },
                                    error: function (response) {
                                        toastr.error('data gagal disimpan');
                                    }
                                });
                            });
                        }
                    });

                  

                }
            });
        }

        function DestroyMediaFile(uuid) {
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
                        url: "/administrator/dashboard/pemberitahuan/gkmediafile/delete/" + uuid,
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
        }

    </script>

    <div class="row" style="margin-top: 0px; margin-bottom: 500px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="display-position" style="margin-bottom: 20px;">
                            <div class="d-flex justify-content-between mb-2">
                                <div style="margin-top: 0px;">
                                    <h4 class="card-title" style="width: 200px;"><b>Daftar Galeri Kegiatan</b></h4>
                                </div>
                            </div>
                            <div class="modalContent">
                                {{-- modal content here! --}}
                            </div>
                            @if (isset($query))
                                <div class="btn-group mb-3" style="margin-left: 5px;">
                                    <button onclick="AddParent()" id="AddParent" class="btn btn-sm btn-success"
                                        style=""><i class="fas fa-plus text-white"></i> Tambah</button>
                                    {{-- <button class="btn btn-sm " style=""><i class="fas fa-pencil-alt text-info" style=""></i></button>
                            <button class="btn btn-sm " style=""><i class="fas fa-trash-alt text-danger" style=""></i></button> --}}
                                </div>
                                <div id="jstree">
                                    <ul>
                                        {{-- parent folder --}}
                                        @foreach ($query as $item)
                                            <li>{{ $item->nama }}
                                                <div class="btn-group" style="margin-left: 5px;">
                                                    <button onclick='AddMediaSub1("{{ $item->id }}")' class="btn btn-sm" style=""><i
                                                            class="fas fa-plus text-success"></i></button>
                                                    <button onclick='EditParent("{{ $item->uuid }}")' class="btn btn-sm "
                                                        style=""><i class="fas fa-pencil-alt text-info"
                                                            style=""></i></button>
                                                    <button onclick='DestroyParent("{{ $item->uuid }}")'
                                                        class="btn btn-sm" style=""><i
                                                            class="fas fa-trash-alt text-danger"
                                                            style=""></i></button>
                                                </div>
                                                <ul>
                                                    {{-- sub folder 1 --}}
                                                    @foreach ($item->gkmediasubf1 as $sub1)
                                                        <li id="">{{ $sub1->nama }}
                                                            <div class="btn-group" style="margin-left: 5px;">
                                                                <button onclick='AddMediaSub2("{{ $sub1->id }}")' class="btn btn-sm" style=""><i
                                                                        class="fas fa-plus text-success"></i></button>
                                                                <button onclick='EditMediaSubF1("{{ $sub1->uuid }}", "{{ $item->id }}")' class="btn btn-sm "
                                                                    style=""><i class="fas fa-pencil-alt text-info"
                                                                        style=""></i></button>
                                                                <button onclick='DestroyMediaSubF1("{{ $sub1->uuid }}")'
                                                                    class="btn btn-sm" style=""><i
                                                                        class="fas fa-trash-alt text-danger"
                                                                        style=""></i></button>
                                                            </div>
                                                            {{-- sub folder 2 --}}
                                                            <ul>
                                                                @foreach($sub1->gkmediasubf2 as $sub2)
                                                                    <li>
                                                                        {{ $sub2->nama }}
                                                                        <button onclick='AddMediaFile("{{ $sub1->id }}")' class="btn btn-sm" style=""><i
                                                                            class="fas fa-plus text-success"></i></button>
                                                                        <button onclick='EditMediaSubF2("{{ $sub2->uuid }}", "{{ $sub1->id }}")' class="btn btn-sm "
                                                                            style=""><i class="fas fa-pencil-alt text-info"
                                                                                style=""></i></button>
                                                                        <button onclick='DestroyMediaSubF2("{{ $sub2->uuid }}")'
                                                                            class="btn btn-sm" style=""><i
                                                                                class="fas fa-trash-alt text-danger"
                                                                                style=""></i></button>
                                                                        
                                                                        {{-- file root --}}
                                                                        <ul>
                                                                            @foreach($sub2->gkmediaFile as $files)
                                                                                <li>
                                                                                    {{-- <i class="jstree-icon mdi mdi-file-pdf"></i> --}}
                                                                                    {{ $files->nama }}
                                                                                    <div class="btn-group">
                                                                                        <button onclick="window.location='{{ '/storage/'.$files->file }}'" class="btn btn-sm"><i class="fas fa-eye"></i></button>
                                                                                        <button onclick='EditMediaFile("{{ $files->uuid }}", "{{ $sub2->id }}")' class="btn btn-sm "
                                                                                            style=""><i class="fas fa-pencil-alt text-info"
                                                                                            style=""></i></button>
                                                                                        <button onclick='DestroyMediaFile("{{ $files->uuid }}")'
                                                                                            class="btn btn-sm" style=""><i
                                                                                            class="fas fa-trash-alt text-danger"
                                                                                            style=""></i></button>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="btn-group" style="margin-left: 5px;">
                                    <button onclick="AddParent()" id="AddParent" class="btn btn-sm" style=""><i
                                            class="fas fa-plus text-success"></i></button>
                                    {{-- <button class="btn btn-sm " style=""><i class="fas fa-pencil-alt text-info" style=""></i></button>
                            <button class="btn btn-sm " style=""><i class="fas fa-trash-alt text-danger" style=""></i></button> --}}
                                </div>
                            @endif
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
