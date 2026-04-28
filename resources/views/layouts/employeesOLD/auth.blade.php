<!DOCTYPE html>
<html
    @if (Config::get('app.locale') == 'ar') lang="ar" data-textdirection="rtl" @else  lang="en" data-textdirection="ltr" @endif>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{!! asset('assets/employees/') !!}/css/style.css">
    <!-- endinject -->
    <link rel="apple-touch-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">
    @stack('style')
</head>

<body class="{!! Lang() == 'en' ? 'with-welcome-text' : 'rtl' !!}">
    @yield('content')
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{!! asset('assets/employees/') !!}/vendors/js/vendor.bundle.base.js"></script>
    <script src="{!! asset('assets/employees/') !!}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{!! asset('assets/employees/') !!}/js/off-canvas.js"></script>
    <script src="{!! asset('assets/employees/') !!}/js/template.js"></script>
    <script src="{!! asset('assets/employees/') !!}/js/settings.js"></script>
    <script src="{!! asset('assets/employees/') !!}/js/hoverable-collapse.js"></script>
    <script src="{!! asset('assets/employees/') !!}/js/todolist.js"></script>
    <!-- endinject -->
    @stack('script')
</body>

</html>
