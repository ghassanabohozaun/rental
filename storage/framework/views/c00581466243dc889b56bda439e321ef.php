<!DOCTYPE html>
<html class="loading"
    <?php if(Config::get('app.locale') == 'ar'): ?> lang="ar" data-textdirection="rtl" <?php else: ?>  lang="en" data-textdirection="ltr" <?php endif; ?>>

<head>
    <?php echo $__env->make('layouts.dashboard.app-parts._head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('style'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="vertical-layout vertical-menu-modern 2-columns  menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns" style="font-family: 'Tajawal', sans-serif;">

    <?php echo $__env->make('layouts.dashboard.app-parts._header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.dashboard.app-parts._sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($slot)): ?>
        <?php echo e($slot); ?>

    <?php else: ?>
        <?php echo $__env->yieldContent('content'); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->make('layouts.dashboard.app-parts._footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.dashboard.app-parts._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php app('flasher')->render('html', ); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\rental\resources\views/layouts/dashboard/app.blade.php ENDPATH**/ ?>