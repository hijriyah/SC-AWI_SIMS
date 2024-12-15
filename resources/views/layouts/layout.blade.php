@once
   <!doctype html>
   <html lang="en" >

      <head>
         <meta charset="utf-8" />
         <title>Dashboard</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
         <meta content="Themesbrand" name="author" />
         <meta name="csrf-token" content="{{ csrf_token() }}">
         {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('/js/app.js') }}"></script> --}}
            @vite(['resources/js/app.js', 'resources/css/app.css'])

         <!-- App favicon -->
         <link rel="shortcut icon" href="{{ asset('Qovex/HTML/dist/assets/images/favicon.ico') }}">

         <!-- jquery.vectormap css -->
         <link href="{{ asset('Qovex/HTML/dist/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
               type="text/css" />

         <!-- <link href="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"> -->
         <!-- Bootstrap Css -->
         <link href="{{ asset('Qovex/HTML/dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
         <!-- Icons Css -->
         <link href="{{ asset('Qovex/HTML/dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
         <!-- App Css-->
         <link href="{{ asset('Qovex/HTML/dist/assets/css/app.min.css') }}"  id="app-style"  rel="stylesheet" type="text/css" />
         <link href="{{ asset('Qovex/HTML/dist/assets/css/style.css') }}"  id="app-style"  rel="stylesheet" type="text/css" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
      </head>

      <body data-layout="detached" data-topbar="colored">

         <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">
               @include('layouts.navbar')

               @include('layouts.sidebar')

               <div class="main-content">
                  <div class="page-content">
                     @yield('content')
                  </div>

                  @include('layouts.footer')
               </div>
            </div>
         </div>

      <!-- JAVASCRIPT -->
      <!-- JAVASCRIPT -->
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/jquery/jquery.min.js') }}"></script>

      <script src="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/node-waves/waves.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>


      <!-- apexcharts -->
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

      <!-- jquery.vectormap map -->
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

      <script src="{{ asset('Qovex/HTML/dist/assets/js/pages/dashboard.init.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/js/pages/chartjs.init.js') }}"></script>

      <script src="{{ asset('Qovex/HTML/dist/assets/js/app.js') }}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      {{-- <!-- <script src="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/select2/js/select2.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/js/pages/form-advanced.init.js') }}"></script> --> --}}
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
      <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
      <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
      <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.js" integrity="sha512-3I+0zIxy2IkeeCvvhXUEu+AFT3zAGuHslHLDmM8JBv6FT7IW6WjhGpUZ55DyGXArYHD0NshixtmNUWJzt0K32w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      {{-- <script src="{{ asset('Qovex/HTML/dist/assets/libs/fullcalendar/index.global.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/moment/min/moment.min.js') }}"></script>
      <script src="{{ asset('Qovex/HTML/dist/assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>

      <!-- Calendar init -->
      <script src="{{ asset('Qovex/HTML/dist/assets/js/pages/calendar.init.js') }}"></script> --}}
      </body>
   </html>
@endonce

