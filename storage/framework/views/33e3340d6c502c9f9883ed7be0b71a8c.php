<input type="hidden" id="property_types-total-count" value="<?php echo $property_types->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('property_types.name'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('property_types.created_by'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('property_types.status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('property_types.manage_status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $property_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$property_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($property_type->id); ?>">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-briefcase font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $property_type->name; ?></h4>
                                    <span class="modal-role-badge"><?php echo __('property_types.property_type'); ?></span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $property_type->id; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value text-muted small">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property_type->company_id): ?>
                                                    <span class="badge badge-light-primary border-0"><?php echo optional($property_type->company)->name; ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-light-warning border-0"><?php echo __('roles.global_role'); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('property_types.status'); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property_type->status == 1): ?>
                                                    <span class="badge badge-success badge-glow badge-pill px-2"><?php echo __('general.enable'); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger badge-glow badge-pill px-2"><?php echo __('general.disabled'); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('property_types.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo $property_type->creator->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($property_types->currentPage() - 1) * $property_types->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property_type->company_id): ?>
                            <a href="javascript:void(0)" class="company-chip">
                                <i class="fas fa-briefcase mr-1"></i> <?php echo optional($property_type->company)->name; ?>

                            </a>
                        <?php else: ?>
                            <span class="badge badge-light-warning border-0">
                                <i class="fas fa-globe mr-1"></i> <?php echo __('roles.global_role'); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>

                    <!-- Name -->
                    <td class="text-center align-middle font-weight-bold text-primary"><?php echo $property_type->name; ?></td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small"><?php echo $property_type->creator->name ?? '---'; ?></span>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.property_types.parts.status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    <!-- Manage Status -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.property_types.parts.manage_status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.property_types.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('property_types.no_property_types_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        <?php echo $property_types->links(); ?>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_types/partials/_table.blade.php ENDPATH**/ ?>