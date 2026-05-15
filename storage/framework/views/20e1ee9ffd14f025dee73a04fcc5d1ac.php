<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
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
                                    <?php echo __('maintenances.maintenances'); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('maintenances_create')): ?>
                            <button type="button" class="btn btn-premium-add shadow-pulse" data-toggle="modal"
                                data-target="#createModal">
                                <i class="fas fa-plus-circle"></i>
                                <?php echo __('maintenances.add_maintenance'); ?>

                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- end: content header right-->
            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <?php echo $__env->make('dashboard.maintenances.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card premium-card-anim">
                                <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                            <i class="fas fa-wrench text-primary mr-2 icon-size-16"></i>
                                            <?php echo __('maintenances.maintenances'); ?>

                                            <span id="maintenancesCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11"><?php echo $maintenances->total(); ?></span>
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
                                        <!-- Container with Loader -->
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                <?php echo $__env->make('dashboard.maintenances.partials._table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php echo $__env->make('dashboard.maintenances.modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('dashboard.maintenances.modals.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('dashboard.maintenances.modals.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/dashbaord/js/ajax-table.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize AJAX Table
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    container: '#table_data',
                    loader: '.table-loader-overlay',
                    detailsControl: '.details-control'
                });
            }

            // Initialize Modern Filter System
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }

            // Initialize Standard Select2 for Modals (Non-AJAX)
            function initMaintenanceSelects(modalSelector) {
                $(modalSelector + ' .js-select2:not(.select2-autocomplete):not(.js-autocomplete)').each(function() {
                    var $el = $(this);
                    var parent = $el.data('parent');
                    $el.select2({
                        dropdownParent: parent ? $(parent) : null,
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr'
                    });
                });
            }

            initMaintenanceSelects('#createModal');
            initMaintenanceSelects('#editModal');

            // --- Dependency Logic: Company -> Property ---
            function handleCompanyChange(companySelect, propertySelect, modalId) {
                $(document).on('change', companySelect, function(e, extra) {
                    const companyId = $(this).val();
                    const $propertySelect = $(propertySelect);

                    // Skip reset if this is an initial population (e.g. when opening edit modal)
                    if (!(extra && extra.initial)) {
                        $propertySelect.val(null).trigger('change');
                    }

                    if (!companyId) {
                        $propertySelect.prop('disabled', true);
                    } else {
                        $propertySelect.prop('disabled', false);
                        
                        // Update AJAX URL for the autocomplete
                        const baseUrl = "<?php echo route('dashboard.properties.autocomplete'); ?>";
                        const newUrl = baseUrl + (baseUrl.includes('?') ? '&' : '?') + "company_id=" + companyId;
                        $propertySelect.attr('data-url', newUrl);

                        // Re-initialize Select2 Autocomplete with new URL
                        if (typeof initGenericSelect2 === "function") {
                            initGenericSelect2($propertySelect, newUrl, $propertySelect.data('placeholder'), modalId);
                        }
                    }
                });
            }

            handleCompanyChange('#company_id_create', '#property_id_create', '#createModal');
            handleCompanyChange('#edit_company_id', '#edit_property_id', '#editModal');

            // Status Change Handler
            $('body').on('change', '.change_status', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var status = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('dashboard.maintenances.change.status')); ?>",
                    data: {
                        status: status,
                        id: id
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function(data) {
                        $('.maintenance_status_' + data.data.id).empty();
                        $('.maintenance_status_' + data.data.id).removeClass(
                            'badge-danger badge-warning badge-success');

                        let badgeClass = 'badge-warning';
                        let statusText = '<?php echo __('maintenances.pending'); ?>';

                        if (data.data.status === 'done') {
                            badgeClass = 'badge-success';
                            statusText = '<?php echo __('maintenances.done'); ?>';
                        } else if (data.data.status === 'in_progress') {
                            badgeClass = 'badge-primary';
                            statusText = '<?php echo __('maintenances.in_progress'); ?>';
                        }

                        $('.maintenance_status_' + data.data.id)
                            .addClass('badge-pill badge-glow ' + badgeClass)
                            .css({
                                'font-size': '11px',
                                'padding': '4px 10px'
                            })
                            .text(statusText);

                        if (data.status === true) {
                            flasher.success("<?php echo __('general.change_status_success_message'); ?>");
                        } else {
                            flasher.error("<?php echo __('general.change_status_error_message'); ?>");
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/maintenances/index.blade.php ENDPATH**/ ?>