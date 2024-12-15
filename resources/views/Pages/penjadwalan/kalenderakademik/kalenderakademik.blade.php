@extends('layouts.layout')


<script type="text/javascript">

    function AddCalendar(start, end=null) {
        let title = $('#Nama').val();
        let description = $('#Description').val();

        if(description == null)
        {
            description = '';
        }
    
        $.ajax({
            url: '{{ route("penjadwalan_kalenderakademik_store") }}',
            type: 'POST',
            data: {
                title: title,
                description: description,
                start: start,
                end: end
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: () => {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    location.reload();
                }, 1300);
            },
            error: () => {
                toastr.error('data gagal disimpan');
            }
        })
    }

    function UpdateCalendar(id, start, end=null) {
        let title = $('#Nama').val();
        let description = $('#Description').val();

        if(description == null)
        {
            description = '';
        }

        $.ajax({
            url: '/administrator/dashboard/penjadwalan/kalenderakademik/update/' + id,
            type: 'POST',
            data: {
                title: title,
                description: description,
                start: start,
                end: end
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: () => {
                toastr.success('data berhasil disimpan');
                setTimeout(() => {
                    location.reload();
                }, 1300);
            },
            error: () => {
                toastr.error('data gagal disimpan');
            }
        })
    }

    

    document.addEventListener('DOMContentLoaded', function() {

        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            contentHeight: 'auto',
            // events: '/administrator/dashboard/penjadwalan/kalenderakademik/events'
            events: function(fetchInfo, successCallback, failureCallback) { 
                const year = new Date().getFullYear();
                fetch(`https://date.nager.at/api/v3/publicholidays/` + year + '/ID') 
                .then(response => response.json()) 
                .then(data => { 
                    var events = data.map(holiday => { 
                        return { 
                            title: holiday.localName, start: holiday.date 
                        }; 
                    }); 
                    successCallback(events); 
                }) 
                .catch(error => failureCallback(error)); 
            },
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

    <div class="row" style="margin-top: 0px; margin-bottom: 100px;">

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

        {{-- <div class="row" style="overflow-y: auto;">
            <div class="col-12">
                <div class="card" style="height: 530px;">
                    <div class="card-body">
                        <div class="display-position" style="margin-bottom: 20px;">
                            <div class="d-flex justify-content-between">
                                <div style="margin-top: 0px;">
                                    <h4 class="card-title" style="width: 140px;"><b>Kalender Akademik</b></h4>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row --> --}}
        <div class="row" style="overflow-y: auto;">
            {{-- start calendar --}}
            <div class="col-lg-12">
                <div class="card mb-0" style="height: 500px;">
                    <div class="card-body">
                        <div id="calendar" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
            {{-- end calendar --}}
        </div>
    </div>
    <!-- End Page-content -->

    </div>
    <!-- end row -->
@endsection
