<?php $__env->startSection('title'); ?>
    <?php echo $title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <form class="form ajax-form" id="myForm" action="<?php echo route('dashboard.roles.update', $role->id); ?>" method="post" enctype="multipart/form-data"
            novalidate data-success-msg="<?php echo __('general.update_success_message'); ?>" data-success-action="redirect"
            data-redirect-url="<?php echo route('dashboard.roles.index'); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
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
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo route('dashboard.roles.index'); ?>">
                                            <?php echo __('roles.roles'); ?>

                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active font-weight-bold">
                                        <?php echo __('roles.update_role'); ?>

                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right">
                        <div class="d-flex align-items-center justify-content-end mb-1 gap-15px">
                            <a href="<?php echo route('dashboard.roles.index'); ?>" class="btn-premium-back">
                                <i class="fas fa-arrow-right"></i> <?php echo __('general.back'); ?>

                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($role->id !== 1): ?>
                                <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                    <i class="fas fa-save mr-2"></i>
                                    <i class="fas fa-spinner fa-spin d-none spinner_loading mr-2"></i>
                                    <?php echo __('general.save'); ?>

                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">

                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card premium-card shadow-lg border-0">
                                    <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                            <i class="fas fa-edit text-primary mr-2 icon-size-16"></i>
                                            <?php echo __('roles.update_role'); ?>

                                        </h6>
                                    </div>
                                    <!-- end: card header -->

                                    <!-- begin: card content -->
                                    <div class="card-content collapse show">
                                        <div class="card-body">


                                            <div class="form-body">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($role->id === 1): ?>
                                                    <!-- begin: Administrative Security Protocol -->
                                                    <div class="alert alert-icon-left alert-arrow-left alert-primary mb-3 shadow-sm border-0"
                                                        role="alert" style="border-radius: 12px;">
                                                        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>
                                                        <h5 class="alert-heading font-weight-bold mb-1">
                                                            <?php echo __('roles.system_role_protected'); ?></h5>
                                                        <p class="mb-0 small">
                                                            <?php echo __('roles.super_admin_protection_msg'); ?>

                                                        </p>
                                                    </div>
                                                    <!-- end: Administrative Security Protocol -->
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies) && $role->id !== 1): ?>
                                                    <!-- begin: Global Role Note -->
                                                    <div class="alert alert-icon-left alert-arrow-left alert-info mb-3 shadow-sm border-0"
                                                        role="alert" style="border-radius: 12px;">
                                                        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>
                                                        <h6 class="alert-heading font-weight-bold mb-1">
                                                            <?php echo __('general.pro_tip'); ?></h6>
                                                        <p class="mb-0" style="font-size: 1.1rem;">
                                                            <?php echo __('roles.global_role_note'); ?>

                                                        </p>
                                                    </div>
                                                    <!-- end: Global Role Note -->
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                <?php if(isset($companies)): ?>
                                                    <div class="row mb-2">
                                                        <div class="col-md-12">
                                                            <div class="premium-form-group">
                                                                <label for="company_id"
                                                                    class="premium-label"><?php echo __('companies.company'); ?></label>
                                                                <select id="company_id" name="company_id"
                                                                    class="form-control premium-input shadow-none select2"
                                                                    <?php if($role->isSystemRole()): echo 'disabled'; endif; ?>
                                                                    <?php if($role->isSystemRole()): ?> style="cursor: not-allowed;" <?php endif; ?>>
                                                                    <option value=""><?php echo __('roles.global_role'); ?></option>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($company->id); ?>"
                                                                            <?php if($role->company_id == $company->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($company->name); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                </select>
                                                                <span
                                                                    class="text-danger error-text company_id_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                <div class="row mb-4px">
                                                    <div class="col-md-6 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="name_ar"
                                                                class="premium-label"><?php echo __('roles.role_ar'); ?> <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="name_ar" name="name[ar]"
                                                                value="<?php echo old('name.ar', $role->getTranslation('name', 'ar')); ?>"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="<?php echo __('roles.enter_role_ar'); ?>"
                                                                <?php if($role->id === 1): echo 'disabled'; endif; ?>>
                                                            <span class="text-danger error-text name_ar_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="name_en"
                                                                class="premium-label"><?php echo __('roles.role_en'); ?> <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="name_en" name="name[en]"
                                                                value="<?php echo old('name.en', $role->getTranslation('name', 'en')); ?>"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="<?php echo __('roles.enter_role_en'); ?>"
                                                                <?php if($role->id === 1): echo 'disabled'; endif; ?>>
                                                            <span class="text-danger error-text name_en_error"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- begin: row -->
                                                <div class="row mb-4px">
                                                    <div class="col-md-12 mb-2">
                                                        <div class="premium-form-group">
                                                            <label for="description"
                                                                class="premium-label"><?php echo __('roles.description'); ?></label>
                                                            <input type="text" id="description" name="description"
                                                                value="<?php echo old('description', $role->description); ?>"
                                                                class="form-control premium-input shadow-none"
                                                                autocomplete="off" placeholder="<?php echo __('roles.enter_description') ?? 'ادخل وصفاً لهذا الدور...'; ?>"
                                                                <?php if($role->id === 1): echo 'disabled'; endif; ?>>
                                                            <span class="text-danger error-text description_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end: row -->

                                                <!-- begin: Premium Permissions Grid -->
                                                <div class="row mt-4px">
                                                    <div class="col-md-12">
                                                        <h5
                                                            class="premium-section-title d-flex align-items-center justify-content-between">
                                                            <span>
                                                                <i class="fas fa-key"></i> <?php echo __('roles.permissions'); ?> <span
                                                                    class="text-danger">*</span>
                                                            </span>
                                                            <span
                                                                class="permissions_error premium-error-alert-chip"></span>
                                                        </h5>

                                                        <div class="permissions-grid">
                                                            <?php
                                                                $rolePermissions = $role->permissions
                                                                    ->pluck('name')
                                                                    ->toArray();
                                                            ?>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('global.modules'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleKey => $moduleLangKey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div
                                                                    class="permission-card <?php echo e($role->id === 1 ? 'disabled-card' : ''); ?>">
                                                                    <div class="permission-card-header">
                                                                        <div class="permission-card-title">
                                                                            <i
                                                                                class="<?php echo e(config('global.module_icons.' . $moduleKey, 'la la-dot-circle')); ?>"></i>
                                                                            <?php echo __($moduleLangKey); ?>

                                                                        </div>
                                                                        <?php
                                                                            $modulePermissions = collect(
                                                                                config('global.crud_operations'),
                                                                            )->map(function ($opLangKey, $opKey) use (
                                                                                $moduleKey,
                                                                            ) {
                                                                                return $moduleKey . '_' . $opKey;
                                                                            });
                                                                            $allChecked =
                                                                                $role->id === 1 ||
                                                                                $modulePermissions->every(function (
                                                                                    $perm,
                                                                                ) use ($rolePermissions) {
                                                                                    return in_array(
                                                                                        $perm,
                                                                                        $rolePermissions,
                                                                                    );
                                                                                });
                                                                        ?>
                                                                        <label class="modern-switch">
                                                                            <input type="checkbox"
                                                                                class="select-all-module"
                                                                                data-module="module-<?php echo e($moduleKey); ?>"
                                                                                <?php if($allChecked): echo 'checked'; endif; ?>
                                                                                <?php if($role->id === 1): echo 'disabled'; endif; ?>>
                                                                            <span class="modern-slider"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="permission-card-body">
                                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('global.crud_operations'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opKey => $opLangKey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php $permName = $moduleKey . '_' . $opKey; ?>
                                                                            <div class="permission-item">
                                                                                <div class="permission-info">
                                                                                    <label
                                                                                        class="permission-label"><?php echo __($opLangKey); ?></label>
                                                                                    <p class="permission-desc">
                                                                                        <?php echo __($opLangKey . '_desc'); ?></p>
                                                                                </div>
                                                                                <label class="modern-switch">
                                                                                    <input type="checkbox"
                                                                                        class="permission-checkbox module-<?php echo e($moduleKey); ?>"
                                                                                        name="permissions[]"
                                                                                        value="<?php echo e($permName); ?>"
                                                                                        <?php if($role->id === 1 || in_array($permName, $rolePermissions)): echo 'checked'; endif; ?>
                                                                                        <?php if($role->id === 1): echo 'disabled'; endif; ?>>
                                                                                    <span class="modern-slider"></span>
                                                                                </label>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                        <div class="text-center mt-3">
                                                            <span
                                                                class="permissions_error premium-error-alert-chip"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end: Premium Permissions Grid -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Permission UI Logic
            function updateSelectAllSwitches() {
                $('.select-all-module').each(function() {
                    let moduleClass = $(this).data('module');
                    let allChecked = $('.' + moduleClass).length > 0 && $('.' + moduleClass).length === $(
                        '.' + moduleClass + ':checked').length;
                    $(this).prop('checked', allChecked);
                });
            }

            // updateSelectAllSwitches(); // No longer needed as it's handled by PHP on load

            $('.select-all-module').on('change', function() {
                let moduleClass = $(this).data('module');
                let isChecked = $(this).is(':checked');
                $('.' + moduleClass).prop('checked', isChecked).trigger('change');
            });

            $('.permission-checkbox').on('change', function() {
                let classes = $(this).attr('class').split(' ');
                let moduleClass = classes.find(c => c.startsWith('module-'));
                let allChecked = $('.' + moduleClass).length === $('.' + moduleClass + ':checked').length;
                $('.select-all-module[data-module="' + moduleClass + '"]').prop('checked', allChecked);
            });

            // Initialize Company Select2 Standard
            if ($('#company_id').length) {
                $('#company_id').select2({
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.dashboard.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rental\resources\views/dashboard/roles/edit.blade.php ENDPATH**/ ?>