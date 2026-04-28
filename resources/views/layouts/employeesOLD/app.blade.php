<!DOCTYPE html>
<html
    @if (Config::get('app.locale') == 'ar') lang="ar" data-textdirection="rtl" @else  lang="en" data-textdirection="ltr" @endif>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/feather/feather.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/mdi/css/materialdesignicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/ti-icons/css/themify-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/typicons/typicons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/simple-line-icons/css/simple-line-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/css/vendor.bundle.base.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{!! asset('assets/employees/vendors/datatables.net-bs4/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/employees/js/select.dataTables.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('vendor/flasher/flasher.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/employees/css/summernote.css') !!}" rel="stylesheet">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet"
        href="{!! asset('assets/employees/css/style.css') !!}?v={{ file_exists(public_path('assets/employees/css/style.css')) ? filemtime(public_path('assets/employees/css/style.css')) : time() }}">
    <!-- endinject -->

    @if (Lang() == 'ar')
        <link rel="stylesheet"
            href="{!! asset('assets/employees/css/vertical-layout-light/style-rtl.css') !!}?v={{ file_exists(public_path('assets/employees/css/vertical-layout-light/style-rtl.css')) ? filemtime(public_path('assets/employees/css/vertical-layout-light/style-rtl.css')) : time() }}">
    @endif

    <!-- Premium Employee Styles -->
    <link rel="stylesheet" type="text/css"
        href="{!! asset('assets/employees/css/employee-premium.css') !!}?v={{ file_exists(public_path('assets/employees/css/employee-premium.css')) ? filemtime(public_path('assets/employees/css/employee-premium.css')) : time() }}">



    @stack('style')
    @livewireStyles
</head>


<body class="with-welcome-text {!! Lang() == 'ar' ? 'rtl' : '' !!}">

    <div class="container-scroller">

        <!-- _navbar -->
        @include('layouts.employees.parts._navbar')
        <!-- _navbar -->


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- _sidebar -->
            @include('layouts.employees.parts._sidebar')
            <!-- _sidebar -->

            <!-- partial -->
            <div class="main-panel">

                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset

                <!-- content-wrapper ends -->

                <!-- _footer -->
                @include('layouts.employees.parts._footer')
                <!-- _footer -->

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{!! asset('assets/employees/vendors/js/vendor.bundle.base.js') !!}"></script>

    {{-- <script src="{!! asset('assets/dashbaord/js/core/libraries/jquery.min.js') !!}" type="text/javascript"></script> --}}
    {{-- <script src="{!! asset('assets/dashbaord/js/core/libraries/bootstrap.min.js') !!}" type="text/javascript"></script> --}}

    <script src="{!! asset('assets/employees/') !!}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{-- <script src="{!! asset('assets/employees/vendors/chart.js/chart.umd.js') !!}"></script>
    <script src="{!! asset('assets/employees/vendors/progressbar.js/progressbar.min.js') !!}"></script> --}}
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{!! asset('assets/employees/js/off-canvas.js') !!}"></script>
    <script src="{!! asset('assets/employees/js/template.js') !!}"></script>
    <script src="{!! asset('assets/employees/js/settings.js') !!}"></script>
    <script src="{!! asset('assets/employees/js/hoverable-collapse.js') !!}"></script>
    <script src="{!! asset('assets/employees/js/todolist.js') !!}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{!! asset('assets/employees/js/jquery.cookie.js') !!}" type="text/javascript"></script>
    {{-- <script src="{!! asset('assets/employees/js/dashboard.js') !!}"></script> --}}
    <!-- End custom js for this page-->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script> --}}
    <script src="{!! asset('vendor/flasher/flasher.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
    <script src="{!! asset('assets/employees/js/summernote.js') !!}"></script>
    <script src="{!! asset(path: 'assets/dashbaord') !!}/js/scripts/my-scripts.js" type="text/javascript"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                window.location.href = "{{ route('employees.logout') }}";
            }
        });

        // Fix for "Blocked aria-hidden on an element because its descendant retained focus" globally
        $(document).on('hide.bs.modal', '.modal', function() {
            if (document.activeElement && $(this).has(document.activeElement).length) {
                document.activeElement.blur();
            }
        });
    </script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
