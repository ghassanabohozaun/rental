<input type="hidden" id="guarantors-total-count" value="<?php echo $guarantors->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo __('guarantors.name'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('guarantors.phone'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('guarantors.id_number'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('guarantors.status'); ?></th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('guarantors_update')): ?>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 120px;"><?php echo __('general.status'); ?></th>
                <?php endif; ?>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $guarantors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$guarantor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($guarantor->id); ?>">
                    <td class="text-center d-lg-none align-middle">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-user font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $guarantor->name; ?></h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        <?php echo __('general.created_at'); ?>: <?php echo is_string($guarantor->created_at) ? $guarantor->created_at : $guarantor->created_at->format('Y-m-d'); ?>

                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $guarantor->id; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('guarantors.phone'); ?></span>
                                            <span class="detail-info-value"><?php echo $guarantor->phone ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('guarantors.id_number'); ?></span>
                                            <span class="detail-info-value"><?php echo $guarantor->id_number ?? '---'; ?></span>
                                        </div>
                                    </div>
                                    

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($guarantor->company)->name ?? __('general.all_companies'); ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('guarantors.status'); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($guarantor->status == 1): ?>
                                                    <span class="badge badge-success badge-glow badge-pill px-2"><?php echo __('general.enable'); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger badge-glow badge-pill px-2"><?php echo __('general.disabled'); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('guarantors.address'); ?></span>
                                            <span class="detail-info-value"><?php echo $guarantor->address ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('guarantors.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($guarantor->creator)->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($guarantors->currentPage() - 1) * $guarantors->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span><?php echo optional($guarantor->company)->name ?? __('general.all_companies'); ?></span>
                        </div>
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold"><?php echo $guarantor->name; ?></span>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-phone"></i> <?php echo $guarantor->phone ?? '---'; ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-credit-card text-muted mr-1"></i> <?php echo $guarantor->id_number ?? '---'; ?>

                        </span>
                    </td>

                    <td class="text-center align-middle">
                        <div class="badge badge-pill badge-glow guarantor_status_<?php echo $guarantor->id; ?> <?php echo $guarantor->status == 1 ? 'badge-success' : 'badge-danger'; ?>"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            <?php echo $guarantor->status == 1 ? __('general.enable') : __('general.disabled'); ?>

                        </div>
                    </td>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('guarantors_update')): ?>
                        <td class="text-center align-middle">
                            <div class="premium-switch-centered-wrapper">
                                <label class="modern-switch">
                                    <input type="checkbox" class="change_status" id="customSwitch_<?php echo e($guarantor->id); ?>" <?php echo e($guarantor->status == 1 ? 'checked' : ''); ?> data-id="<?php echo e($guarantor->id); ?>" />
                                    <span class="modern-slider"></span>
                                </label>
                            </div>
                        </td>
                    <?php endif; ?>

                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.guarantors.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('guarantors.no_guarantors_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    <?php echo $guarantors->links(); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/guarantors/partials/_table.blade.php ENDPATH**/ ?>