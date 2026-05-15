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
                                    <?php echo __('bank_accounts.bank_accounts'); ?>

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <button type="button" class="btn btn-premium-add shadow-pulse" data-toggle="modal"
                            data-target="#createBankAccountModal">
                            <i class="fas fa-plus-circle"></i>
                            <?php echo __('bank_accounts.create_new_bank_account'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- Search Filters (Moved standalone out) -->
            <?php echo $__env->make('dashboard.bank_accounts.partials._search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                        <i class="fas fa-university text-primary mr-2 icon-size-16"></i>
                                        <?php echo __('bank_accounts.bank_accounts'); ?>

                                        <span id="bank_accountsCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11"><?php echo $bankAccounts->total(); ?></span>
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
                                                <?php echo $__env->make('dashboard.bank_accounts.partials._table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php echo $__env->make('dashboard.bank_accounts.modals.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('dashboard.bank_accounts.modals.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('dashboard.bank_accounts.modals.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/dashbaord/js/ajax-table.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    detailsModal: "#detailsBankAccountModal",
                    detailsModalBody: "#detailsBankAccountModalBody"
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/bank_accounts/index.blade.php ENDPATH**/ ?>