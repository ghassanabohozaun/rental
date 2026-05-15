<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
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
                                    <?php echo __('companies.companies'); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companies_create')): ?>
                        <button type="button" class="btn btn-premium-add shadow-pulse" data-toggle="modal"
                            data-target="#addCompanyModal">
                            <i class="fas fa-plus-circle"></i>
                            <?php echo __('companies.create_new_company'); ?>

                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Search Filters -->
            <?php echo $__env->make('dashboard.companies.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                            <i class="fas fa-briefcase text-primary mr-2 icon-size-16"></i>
                                            <?php echo __('companies.companies'); ?>

                                            <span id="companiesCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11"><?php echo $companies->total(); ?></span>
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
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay" id="tableLoader">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                <?php echo $__env->make('dashboard.companies.partials._table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: card content -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php echo $__env->make('dashboard.companies.modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('dashboard.companies.modals.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('dashboard.companies.modals.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/dashbaord/js/ajax-table.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    detailsModal: "#detailsCompanyModal",
                    detailsModalBody: "#detailsCompanyModalBody"
                });
            }

            // Global Select2 Initialization for all modals in this page
            $('.select2').each(function() {
                var $el = $(this);
                var parentModal = $el.closest('.modal');
                
                $el.select2({
                    dropdownParent: parentModal.length ? parentModal : $(document.body),
                    width: '100%',
                    placeholder: $el.attr('placeholder') || "<?php echo __('general.choose'); ?>",
                });
            });
        });

        // change status
        $(document).on('change', '.change_status', function(e) {
            var id = $(this).data('id');
            var statusSwitch = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "<?php echo e(route('dashboard.companies.status')); ?>",
                data: {
                    statusSwitch: statusSwitch,
                    id: id
                },
                type: 'post',
                dataType: 'JSON',
                success: function(data) {
                    let statusBadge = $('.company_status_' + data.data.id);
                    statusBadge.removeClass('badge-danger badge-success');
                    
                    if (data.data.status == 1) {
                        statusBadge.addClass('badge-success').text("<?php echo __('general.enable'); ?>");
                    } else {
                        statusBadge.addClass('badge-danger').text("<?php echo __('general.disabled'); ?>");
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



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/index.blade.php ENDPATH**/ ?>