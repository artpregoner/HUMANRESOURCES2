<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="{{ asset('asset/libs/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/charts/c3charts/c3.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('template/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    {{-- <link href="{{ asset('template/assets/vendor/full-calendar/css/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
    <link href="{{ asset('template/assets/vendor/full-calendar/css/fullcalendar.css') }}" rel='stylesheet' /> --}}
    <link rel="icon" href="{{ asset('template/images/storelogo.png') }}" type="image/x-icon">
    <!-- TAble CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/summernote/css/summernote-bs4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/select2/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/bootstrap-select/css/bootstrap-select.css') }}">
    @stack('styles')
    @yield('styles')
    @livewireStyles

    <title>@yield('title')</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        @if (Auth::check())
            @php
                $role = Auth::user()->role;
            @endphp

            @include('layouts.topbar')
            @if ($role == 'hr')
                @include('layouts.hr2-layouts.sidebar') <!-- Sidebar for admin and HR-->
            @elseif ($role == 'admin')
                @include('layouts.admin-layouts.sidebar') <!--Admin-->
            @elseif($role == 'employee')
                @include('layouts.portal-layouts.sidebar') <!-- Sidebar for employee -->
            @endif
            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        @include('layouts.pageheader') <!--pageheader -->
                        @yield('content')<!--Content of dashboard-->
                    </div>
                </div>
                @include('layouts.footer') <!-- Shared footer -->
            </div>
        @endif
    </div>

    <!-- Optional JavaScript -->
    <script src="{{ asset('assets/libs/js/javascript.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/charts/sparkline/spark-js.js') }}"></script>
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('template/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('template/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('template/assets/libs/js/main-js.js') }}"></script>
    <!-- chart chartist js -->
    <script src="{{ asset('template/assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <!-- sparkline js -->
    <script src="{{ asset('template/assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- morris js -->
    <script src="{{ asset('template/assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <!-- chart c3 js -->
    <script src="{{ asset('template/assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    <script src="{{ asset('template/assets/libs/js/dashboard-ecommerce.js') }}"></script>

    {{-- <script src="{{ asset('template/assets/vendor/full-calendar/js/moment.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/full-calendar/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/full-calendar/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/full-calendar/js/calendar.js') }}"></script> --}}

    <script src="{{ asset('asset/libs/js/javascript.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/data-table.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/summernote/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/moment.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datepicker/datepicker.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
    @livewireScripts

</body>

</html>
