@extends('layouts.layout')


<script type="text/javascript">

    // function AddCalendar(start, end=null) {
    //     let title = $('#Nama').val();
    //     let description = $('#Description').val();

    //     if(description == null)
    //     {
    //         description = '';
    //     }
    
    //     $.ajax({
    //         url: '{{ route("penjadwalan_jadwalpertemuan_store") }}',
    //         type: 'POST',
    //         data: {
    //             title: title,
    //             description: description,
    //             start: start,
    //             end: end
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         success: () => {
    //             toastr.success('data berhasil disimpan');
    //             setTimeout(() => {
    //                 location.reload();
    //             }, 1300);
    //         },
    //         error: () => {
    //             toastr.error('data gagal disimpan');
    //         }
    //     })
    // }

    // function UpdateCalendar(id, start, end=null) {
    //     let title = $('#Nama').val();
    //     let description = $('#Description').val();

    //     if(description == null)
    //     {
    //         description = '';
    //     }

    //     $.ajax({
    //         url: '/administrator/dashboard/penjadwalan/jadwalpertemuan/update/' + id,
    //         type: 'POST',
    //         data: {
    //             title: title,
    //             description: description,
    //             start: start,
    //             end: end
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         success: () => {
    //             toastr.success('data berhasil disimpan');
    //             setTimeout(() => {
    //                 location.reload();
    //             }, 1300);
    //         },
    //         error: () => {
    //             toastr.error('data gagal disimpan');
    //         }
    //     })
    // }

    

    document.addEventListener('DOMContentLoaded', function() {

        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            contentHeight: 'auto',
            events: '/guru/dashboard/penjadwalan/jadwalpertemuan/events',
            selectable: true,
            // select: function(info) {
            //     $('.modal').remove();
                
            //     $('.modal-content').append(`
            //             <div class="modal" tabindex="-1" id="AddCalendarEvent">
            //             <div class="modal-dialog">
            //                 <div class="modal-content">
            //                 <div class="modal-header">
            //                     <h5 class="modal-title">Tambah Kalender</h5>
            //                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            //                 </div>
            //                 <div class="modal-body">
            //                     <div class="row mb-2">
            //                         <div class="col-md-12">
            //                             <label class="form-label" for="Nama">Nama</label>
            //                             <input type="text" class="form-control Nama" id="Nama" />
            //                         </div>
            //                     </div>
            //                     <div class="row">
            //                         <div class="col-md-12">
            //                             <label class="form-label" for="Deksripsi">Deskripsi</label>
            //                             <textarea class="form-control Description" style="height: 100px;" id="Description"></textarea>
            //                         </div>
            //                     </div>
            //                 </div>
            //                 <div class="modal-footer">
            //                     <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
            //                     <button type="button" class="btn btn-sm btn-success" onclick="AddCalendar('${info.startStr}', '${info.endStr}')"><i class="mdi mdi-telegram"></i> Save</button>
            //                 </div>
            //                 </div>
            //             </div>
            //             </div>
            //     `);
            //     $('#AddCalendarEvent').modal('show');

            },
            // eventClick: function(info) {
            //     $.ajax({
            //         url: '/administrator/dashboard/penjadwalan/jadwalpertemuan/edit/' + info.event.id,
            //         type: 'GET',
            //         success: (response) => {
            //             $('.modal').remove();
                
            //             $('.modal-content').append(`
            //                     <div class="modal" tabindex="-1" id="EditCalendarEvent">
            //                     <div class="modal-dialog">
            //                         <div class="modal-content">
            //                         <div class="modal-header">
            //                             <h5 class="modal-title">Edit Kalender</h5>
            //                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            //                         </div>
            //                         <div class="modal-body">
            //                             <div class="row mb-2">
            //                                 <div class="col-md-12">
            //                                     <label class="form-label" for="Nama">Nama</label>
            //                                     <input type="text" class="form-control Nama" id="Nama" value="${response.data.title}" />
            //                                 </div>
            //                             </div>
            //                             <div class="row">
            //                                 <div class="col-md-12">
            //                                     <label class="form-label" for="Deksripsi">Deskripsi</label>
            //                                     <textarea class="form-control Description" style="height: 100px;" id="Description">${response.data.description}</textarea>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         <div class="modal-footer">
            //                             <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="mdi mdi-close-circle-outline"></i> Close</button>
            //                             <button type="button" class="btn btn-sm btn-success" onclick="UpdateCalendar('${info.event.id}', '${response.data.start}', '${response.data.end}')"><i class="mdi mdi-telegram"></i> Save</button>
            //                         </div>
            //                         </div>
            //                     </div>
            //                     </div>
            //             `);
            //             $('#EditCalendarEvent').modal('show');
            //         }
            //     })

               
            // },
        });
        calendar.render();

    });
</script>

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

    <div class="row" style="margin-top: 0px; margin-bottom: 500px;">

        <!-- start page title -->
        <!--<div class="row">
                       <div class="col-12">
                           <div class="page-title-box d-flex align-items-center justify-content-between">
                           </div>
                       </div>
                   </div>-->
        <!-- end page title -->
        <div class="modal-content">
            {{-- modal content here --}}
        </div>

        <div class="row" style="overflow-y: auto;">
            <div class="col-12">
                <div class="card" style="height: 500px;">
                    <div class="card-body">
                        <div class="display-position" style="margin-bottom: 20px;">
                            <div class="d-flex justify-content-between">
                                <div style="margin-top: 0px;">
                                    <h4 class="card-title" style="width: 140px;"><b>Jadwal Pertemuan</b></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- start calendar --}}
                            <div class="col-lg-12">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div id="calendar" style="height: 500px;"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- end calendar --}}
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
