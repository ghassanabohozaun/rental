<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="PIXINVENT">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{!! __('dashboard.dashboard') !!} | @yield('title')</title>

<link rel="apple-touch-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">
<link rel="shortcut icon" type="image/x-icon" href="{!! asset('uploads/settings/' . setting()->favicon) !!}">
<link href="{!! asset('assets/dashbaord/fonts/google/font.css') !!}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/fonts/line-awesome/css/line-awesome.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/vendors/fontawesome/css/all.min.css') !!}">

<link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/vendors/css/weather-icons/climacons.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/fonts/meteocons/style.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/vendors/css/charts/morris.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset(path: 'assets/dashbaord/fonts/simple-line-icons/style.css') !!}">
<link rel="stylesheet" href="{!! asset('vendor/flasher/flasher.min.css') !!}">
<link href="{!! asset('vendor/summernote/summernote-bs4.css') !!}" rel="stylesheet">

<!-- BEGIN: Dashboard Core CSS -->
<!-- Vendor Assets (Load first to allow overrides) -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/filter.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/ajax-table.css') }}">
<link rel="stylesheet" href="{!! asset('vendor/fileInput/css/fileinput.min.css') !!}?v={{ time() }}">

<!-- Select2 Vendor CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/vendors/css/forms/selects/select2.min.css') }}">

<!-- Custom CSS File -->
@if (Lang() == 'ar')
    <link rel="stylesheet" href="{!! asset('vendor/fileInput/css/fileinput-rtl.min.css') !!}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/vendors.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/app.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/custom-rtl.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/core/colors/palette-gradient.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/sidebar-navy-rtl.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css-rtl/my-style.css') }}?v={{ time() }}">
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/app.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css/vendors.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/app.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css/core/menu/menu-types/vertical-menu-modern.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css/core/colors/palette-gradient.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css/sidebar-navy.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashbaord/css/my-style.css') }}?v={{ time() }}">
@endif

<!-- Ultra Premium Sidebar Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/premium-sidebar.css') }}?v={{ time() }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashbaord/css/premium-select2.css') }}?v={{ time() }}">
<!-- END: Core CSS -->
