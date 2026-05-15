<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/dashbaord/css/permissions.css'); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row">

                <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo route('dashboard.index'); ?>">
                                        <i class="fas fa-home"></i> <?php echo __('dashboard.home'); ?>

                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    <?php echo __('roles.roles'); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12">
                    <div class="float-md-right mb-1">
                        <a href="<?php echo route('dashboard.roles.create'); ?>" class="btn btn-premium-add shadow-pulse">
                            <i class="fas fa-plus-circle"></i>
                            <?php echo __('roles.create_new_role'); ?>

                        </a>
                    </div>
                </div>
                <!-- end: content header right-->

            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <?php echo $__env->make('dashboard.roles.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                            <i class="fas fa-shield-alt text-primary mr-2 icon-size-16"></i> 
                                            <?php echo __('roles.roles'); ?>

                                            <span id="rolesCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11"><?php echo $roles->total(); ?></span>
                                        </h6>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="fas fa-sync"></i></a></li>
                                            <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->


                                <!-- begin: card content -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay" id="tableLoader">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                <?php echo $__env->make('dashboard.roles.partials._table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: card content -->
                            </div>
                        </div> <!-- end: card  -->
                    </div><!-- end: row  -->
                </section><!-- end: sections  -->
            </div><!-- end: content body  -->
        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->
    <?php echo $__env->make('dashboard.roles.modals.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/dashbaord/js/ajax-table.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dashbaord/js/generic-select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable();
            }
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }
        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/roles/index.blade.php ENDPATH**/ ?>