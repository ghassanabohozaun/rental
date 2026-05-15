<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row align-items-center mb-2">
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb shadow-sm">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo route('dashboard.index'); ?>">
                                        <i class="fas fa-home mr-1"></i> <?php echo __('dashboard.home'); ?>

                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="fas fa-briefcase mr-1 pointer-events-none"></i> <?php echo __('property_statuses.property_statuses'); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <button type="button" class="btn btn-premium-add shadow-pulse h-42 radius-10" data-toggle="modal"
                            data-target="#createproperty_statusModal">
                            <i class="fas fa-plus-circle mr-1"></i>
                            <?php echo __('property_statuses.create_new_property_status'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- Search Filters (Moved standalone out) -->
            <?php echo $__env->make('dashboard.property_statuses.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h4 class="card-title text-dark font-weight-bold d-flex align-items-center">
                                        <i class="fas fa-briefcase text-primary mr-2 font-24"></i>
                                        <?php echo __('property_statuses.property_statuses'); ?>

                                        <span id="property_statusesCountBadge"
                                            class="badge badge-primary badge-pill badge-glow ml-2 font-11"><?php echo $property_statuses->total(); ?></span>
                                    </h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="fas fa-sync"></i></a></li>
                                            <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay" id="tableLoader">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                <?php echo $__env->make('dashboard.property_statuses.partials._table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php echo $__env->make('dashboard.property_statuses.modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('dashboard.property_statuses.modals.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('dashboard.property_statuses.modals.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/dashbaord/js/ajax-table.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    detailsModal: "#detailsproperty_statusModal",
                    detailsModalBody: "#detailsproperty_statusModalBody"
                });
            }
        });

        // change status
        $(document).on('change', '.change_status', function(e) {
            // e.preventDefault();
            var id = $(this).data('id');

            if ($(this).is(':checked')) {
                statusSwitch = 1;
            } else {
                statusSwitch = 0;
            }


            $.ajax({
                url: "<?php echo e(route('dashboard.property_statuses.change.status')); ?>",
                data: {
                    statusSwitch: statusSwitch,
                    id: id
                },
                type: 'post',
                dataType: 'JSON',
                success: function(data) {

                    $('.property_status_status_' + data.data.id).empty();
                    $('.property_status_status_' + data.data.id).removeClass('badge-danger');
                    $('.property_status_status_' + data.data.id).removeClass('badge-success');
                    if (data.data.status == 1) {
                        $('.property_status_status_' + data.data.id).addClass('badge-success');
                        $('.property_status_status_' + data.data.id).text("<?php echo __('general.enable'); ?>");
                    } else if (data.data.status == 0) {
                        $('.property_status_status_' + data.data.id).addClass('badge-danger');
                        $('.property_status_status_' + data.data.id).text("<?php echo __('general.disabled'); ?>");
                    }

                    if (data.status === true) {
                        flasher.success("<?php echo __('general.change_status_success_message'); ?>");
                    } else {
                        flasher.error("<?php echo __('general.change_status_error_message'); ?>");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        flasher.error("<?php echo __('dashboard.access_denied'); ?>");
                        // Revert switch state
                        var checkbox = $('#status_' + id);
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    } else {
                        flasher.error("<?php echo __('general.try_catch_error_message'); ?>");
                    }
                }
            });

        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_statuses/index.blade.php ENDPATH**/ ?>