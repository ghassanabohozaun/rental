<input type="hidden" id="owners-total-count" value="<?php echo $owners->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('owners.type'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('owners.identification_number'); ?></th>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo __('owners.name'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('owners.phone'); ?></th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $owners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($owner->id); ?>">
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
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $owner->name; ?></h4>
                                    
                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        <?php echo __('general.created_at'); ?>: <?php echo is_string($owner->created_at) ? $owner->created_at : $owner->created_at->format('Y-m-d'); ?>

                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $owner->id; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('owners.phone'); ?></span>
                                            <span class="detail-info-value"><?php echo $owner->phone ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-id-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('owners.identification_number'); ?></span>
                                            <span class="detail-info-value"><?php echo $owner->identification_number ?? '---'; ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-tags"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('owners.type'); ?></span>
                                            <span class="detail-info-value"><?php echo isset($owner->type) ? __('owners.owner_types.' . $owner->type) : '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($owner->company)->name ?? __('general.all_companies'); ?></span>
                                        </div>
                                    </div>

                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('owners.address'); ?></span>
                                            <span class="detail-info-value"><?php echo $owner->address ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('owners.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($owner->creator)->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($owners->currentPage() - 1) * $owners->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            <?php echo optional($owner->company)->name ?? __('general.all_companies'); ?>

                        </a>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill bg-light-info text-info font-weight-bold px-3 py-1">
                            <i class="fas fa-tag mr-1"></i> <?php echo isset($owner->type) ? __('owners.owner_types.' . $owner->type) : '---'; ?>

                        </span>
                    </td>

                    <!-- ID Number -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-id-card text-muted mr-1"></i> <?php echo $owner->identification_number ?? '---'; ?>

                        </span>
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold"><?php echo $owner->name; ?></span>
                            <span class="user-email-text"><?php echo $owner->email ?? '---'; ?></span>
                        </div>
                    </td>

                    <!-- Phone -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-phone"></i> <?php echo $owner->phone ?? '---'; ?>

                        </span>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.owners.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle mr-1"></i> <?php echo __('owners.no_owners_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    <?php echo $owners->links(); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/owners/partials/_table.blade.php ENDPATH**/ ?>