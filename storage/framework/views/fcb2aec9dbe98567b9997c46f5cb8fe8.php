<input type="hidden" id="users-total-count" value="<?php echo $users->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('users.photo'); ?></th>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo __('users.users'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('users.role_id'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('users.created_by'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('users.status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 120px;"><?php echo __('users.manage_status'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;"><?php echo __('general.actions'); ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($user->id); ?>">
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
                                    <!-- Simple & Clean Profile Image -->
                                    <div class="modal-profile-wrapper">
                                        <?php echo $__env->make('dashboard.users.parts.photo', ['size' => 100], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>

                                    <h4 class="modal-name-title font-weight-bold"><?php echo $user->name; ?></h4>
                                    <span class="modal-role-badge"><?php echo optional($user->role)->name; ?></span>

                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        <?php echo __('general.created_at'); ?>: <?php echo is_string($user->created_at) ? $user->created_at : $user->created_at->format('Y-m-d'); ?>

                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $user->id; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('users.email'); ?></span>
                                            <span class="detail-info-value"><?php echo $user->email; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('users.role_id'); ?></span>
                                            <span
                                                class="detail-info-value text-primary font-weight-bold"><?php echo optional($user->role)->name; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($user->company)->name; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('users.status'); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status == 1): ?>
                                                    <span
                                                        class="badge badge-success badge-glow badge-pill px-2"><?php echo __('general.enable'); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge badge-danger badge-glow badge-pill px-2"><?php echo __('general.disabled'); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('users.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo $user->creator->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($users->currentPage() - 1) * $users->perPage(); ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            <?php echo optional($user->company)->name ?? __('general.all_companies'); ?>

                        </a>
                    </td>
                    <td class="text-center d-none d-lg-table-cell align-middle">
                        <div class="d-flex justify-content-center">
                            <?php echo $__env->make('dashboard.users.parts.photo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </td>
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold"><?php echo $user->name; ?></span>
                            <span class="user-email-text"><?php echo $user->email; ?></span>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span
                            class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <?php echo optional($user->role)->name; ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small"><?php echo $user->creator->name ?? '---'; ?></span>
                    </td>
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.users.parts.status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.users.parts.manage_status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.users.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('users.no_users_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-right custom-pagination mt-2">
    <?php echo $users->links(); ?>

</div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/users/partials/_table.blade.php ENDPATH**/ ?>