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
        // function SearchData()
        // {
        //     var search = $('#search').val();

        //     $.ajax({
        //         url: "{{ route('bukumedia_ebooks_page') }}",
        //         type: "GET",
        //         data: { search: search},
        //         success: function(response) {
        //             $('#table-body').html(response.html);
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(error);
        //         }
        //     });
        // }

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
        
       

    </script>

    <div class="row" style="margin-top: 0px; margin-bottom: 500px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="display-position" style="margin-bottom: 20px;">
                            <div class="d-flex justify-content-between mb-2">
                                <div style="margin-top: 10px;">
                                    <h4 class="card-title" style="width: 250px;"><b>Daftar Media Pembelajaran</b></h4>
                                </div>
                            </div>
                            <div class="modalContent">
                                {{-- modal content here! --}}
                            </div>
                            @if (isset($query))
                                <div class="btn-group mb-3" style="margin-left: 5px;">
                                    {{-- <button onclick="AddParent()" id="AddParent" class="btn btn-sm btn-success"
                                        style=""><i class="fas fa-plus text-white"></i> Tambah</button> --}}
                                    {{-- <button class="btn btn-sm " style=""><i class="fas fa-pencil-alt text-info" style=""></i></button>
                            <button class="btn btn-sm " style=""><i class="fas fa-trash-alt text-danger" style=""></i></button> --}}
                                </div>
                                <div id="jstree">
                                    <ul>
                                        {{-- parent folder --}}
                                        @foreach ($query as $item)
                                            <li>{{ $item->nama }}
                                                {{-- <div class="btn-group" style="margin-left: 5px;">
                                                    <button onclick='AddMediaSub1("{{ $item->id }}")' class="btn btn-sm" style=""><i
                                                            class="fas fa-plus text-success"></i></button>
                                                    <button onclick='EditParent("{{ $item->uuid }}")' class="btn btn-sm "
                                                        style=""><i class="fas fa-pencil-alt text-info"
                                                            style=""></i></button>
                                                    <button onclick='DestroyParent("{{ $item->uuid }}")'
                                                        class="btn btn-sm" style=""><i
                                                            class="fas fa-trash-alt text-danger"
                                                            style=""></i></button>
                                                </div> --}}
                                                <ul>
                                                    {{-- sub folder 1 --}}
                                                    @foreach ($item->mediaSubF1 as $sub1)
                                                        <li id="">{{ $sub1->nama }}
                                                            {{-- <div class="btn-group" style="margin-left: 5px;">
                                                                <button onclick='AddMediaSub2("{{ $sub1->id }}")' class="btn btn-sm" style=""><i
                                                                        class="fas fa-plus text-success"></i></button>
                                                                <button onclick='EditMediaSubF1("{{ $sub1->uuid }}", "{{ $item->id }}")' class="btn btn-sm "
                                                                    style=""><i class="fas fa-pencil-alt text-info"
                                                                        style=""></i></button>
                                                                <button onclick='DestroyMediaSubF1("{{ $sub1->uuid }}")'
                                                                    class="btn btn-sm" style=""><i
                                                                        class="fas fa-trash-alt text-danger"
                                                                        style=""></i></button>
                                                            </div> --}}
                                                            {{-- sub folder 2 --}}
                                                            <ul>
                                                                @foreach($sub1->mediaSubF2 as $sub2)
                                                                    <li>
                                                                        {{ $sub2->nama }}
                                                                        {{-- <button onclick='AddMediaFile("{{ $sub1->id }}")' class="btn btn-sm" style=""><i
                                                                            class="fas fa-plus text-success"></i></button>
                                                                        <button onclick='EditMediaSubF2("{{ $sub2->uuid }}", "{{ $sub1->id }}")' class="btn btn-sm "
                                                                            style=""><i class="fas fa-pencil-alt text-info"
                                                                                style=""></i></button>
                                                                        <button onclick='DestroyMediaSubF2("{{ $sub2->uuid }}")'
                                                                            class="btn btn-sm" style=""><i
                                                                                class="fas fa-trash-alt text-danger"
                                                                                style=""></i></button> --}}
                                                                        
                                                                        {{-- file root --}}
                                                                        <ul>
                                                                            @foreach($sub2->mediaFile as $files)
                                                                                <li>
                                                                                    {{-- <i class="jstree-icon mdi mdi-file-pdf"></i> --}}
                                                                                    {{ $files->nama }}
                                                                                    <div class="btn-group">
                                                                                        @if($files->file)
                                                                                            <button onclick="window.location='{{ '/storage/'.$files->file }}'" class="btn btn-sm"><i class="fas fa-eye"></i></button>
                                                                                        @elseif($files->link)
                                                                                            <button onclick="window.location = '{{ $files->link }}'" class="btn btn-sm"><i class="fas fa-link"></i></button>
                                                                                        @endif
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
