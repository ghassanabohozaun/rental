<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="PIXINVENT">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo __('dashboard.dashboard'); ?> | <?php echo $__env->yieldContent('title'); ?></title>

<link rel="apple-touch-icon" href="<?php echo asset('uploads/settings/' . setting()->favicon); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo asset('uploads/settings/' . setting()->favicon); ?>">
<!-- Preload Local Fonts to prevent FOUT/FOIT -->
<link rel="preload" href="<?php echo asset('assets/dashbaord/fonts/google/Tajawal-400.ttf'); ?>" as="font" type="font/ttf" crossorigin>
<link rel="preload" href="<?php echo asset('assets/dashbaord/fonts/google/Tajawal-500.ttf'); ?>" as="font" type="font/ttf" crossorigin>
<link rel="preload" href="<?php echo asset('assets/dashbaord/fonts/google/Tajawal-700.ttf'); ?>" as="font" type="font/ttf" crossorigin>

<!-- Preload Icons -->
<link rel="preload" href="<?php echo asset('assets/dashbaord/vendors/fontawesome/webfonts/fa-solid-900.woff2'); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo asset('assets/dashbaord/fonts/line-awesome/fonts/line-awesome.woff2'); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo asset('assets/dashbaord/fonts/feather/fonts/feather.woff'); ?>" as="font" type="font/woff" crossorigin>

<!-- Preconnect for external fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Load Poppins from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=block"
    rel="stylesheet">

<!-- Load local fonts (Tajawal, Open Sans, etc) -->
<link href="<?php echo asset('assets/dashbaord/fonts/google/font.css'); ?>" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashbaord/fonts/line-awesome/css/line-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashbaord/vendors/fontawesome/css/all.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashbaord/fonts/feather/style.min.css'); ?>">

<link rel="stylesheet" href="<?php echo asset('vendor/flasher/flasher.min.css'); ?>">

<!-- BEGIN: Dashboard Core CSS -->
<!-- Vendor Assets (Load first to allow overrides) -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/select2.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/filter.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/ajax-table.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" href="<?php echo asset('vendor/fileInput/css/fileinput.min.css'); ?>?v=<?php echo e(time()); ?>">

<!-- Select2 Vendor CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/vendors/css/forms/selects/select2.min.css')); ?>">

<!-- Custom CSS File -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Lang() == 'ar'): ?>
    <link rel="stylesheet" href="<?php echo asset('vendor/fileInput/css/fileinput-rtl.min.css'); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/vendors.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/app.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/custom-rtl.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/core/menu/menu-types/vertical-menu-modern.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/core/colors/palette-gradient.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css-rtl/sidebar-navy-rtl.css')); ?>?v=<?php echo e(time()); ?>">
<?php else: ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/vendors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/app.css')); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css/vendors.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css/app.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css/core/menu/menu-types/vertical-menu-modern.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css/core/colors/palette-gradient.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets/dashbaord/css/sidebar-navy.css')); ?>?v=<?php echo e(time()); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/pages.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo e(asset('assets/dashbaord/css/system-style.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo e(asset('assets/dashbaord/css/premium-navbar.css')); ?>?v=<?php echo e(time()); ?>">

<!-- Ultra Premium Styles -->
<link rel="stylesheet" type="text/css"
    href="<?php echo e(asset('assets/dashbaord/css/premium-sidebar.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo e(asset('assets/dashbaord/css/system-flasher.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo e(asset('assets/dashbaord/css/premium-fileinput.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashbaord/css/premium-select2.css')); ?>">
<!-- END: Core CSS -->

<!-- Base Typography (Loaded LAST to guarantee it overrides RTL Bootstrap and custom files) -->
<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashbaord/css/typography-base.css'); ?>">
<?php /**PATH C:\laragon\www\rental\resources\views/layouts/dashboard/app-parts/_head.blade.php ENDPATH**/ ?>