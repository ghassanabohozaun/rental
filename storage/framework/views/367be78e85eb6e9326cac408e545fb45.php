<input type="hidden" id="customers-total-count" value="<?php echo e($customers->total()); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo e(__('companies.company')); ?></th>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo e(__('customers.name_ar')); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo e(__('customers.phone')); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo e(__('customers.id_number')); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo e(__('customers.nationality')); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo e(__('customers.status')); ?></th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_update')): ?>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 120px;"><?php echo e(__('general.manage_status')); ?></th>
                <?php endif; ?>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;"><?php echo e(__('general.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($customer->id); ?>">
                    <td class="text-center d-lg-none align-middle">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-user font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo e($customer->name); ?></h4>
                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        <?php echo e(__('general.created_at')); ?>: <?php echo e(is_string($customer->created_at) ? $customer->created_at : optional($customer->created_at)->format('Y-m-d')); ?>

                                    </div>
                                </div>
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo e(__('general.system_id')); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo e($customer->id); ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo e(__('customers.phone')); ?></span>
                                            <span class="detail-info-value"><?php echo e($customer->phone ?? '---'); ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo e(__('customers.id_number')); ?></span>
                                            <span class="detail-info-value"><?php echo e($customer->id_number ?? '---'); ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo e(__('companies.company')); ?></span>
                                            <span class="detail-info-value"><?php echo e(optional($customer->company)->name ?? __('general.all_companies')); ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo e(__('customers.status')); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->status == 1): ?>
                                                    <span class="badge badge-success badge-glow badge-pill px-2"><?php echo e(__('general.enable')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger badge-glow badge-pill px-2"><?php echo e(__('general.disabled')); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo e($loop->iteration + ($customers->currentPage() - 1) * $customers->perPage()); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span><?php echo e(optional($customer->company)->name ?? __('general.all_companies')); ?></span>
                        </div>
                    </td>

                    <!-- Name -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold"><?php echo e($customer->name); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->email): ?>
                                <span class="user-email-text"><?php echo e($customer->email); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-phone"></i> <?php echo e($customer->phone ?? '---'); ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-credit-card text-muted mr-1"></i> <?php echo e($customer->id_number ?? '---'); ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="badge badge-light-primary border-0 px-3 py-1 radius-10">
                            <i class="fas fa-flag mr-1"></i> <?php echo e(optional($customer->nationality)->name ?? '---'); ?>

                        </div>
                    </td>

                    <td class="text-center align-middle">
                        <div class="badge badge-pill badge-glow customer_status_<?php echo e($customer->id); ?> <?php echo e($customer->status == 1 ? 'badge-success' : 'badge-danger'); ?>"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            <?php echo e($customer->status == 1 ? __('general.enable') : __('general.disabled')); ?>

                        </div>
                    </td>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_update')): ?>
                        <td class="text-center align-middle">
                            <div class="premium-switch-centered-wrapper">
                                <label class="modern-switch">
                                    <input type="checkbox" class="change_status" id="customSwitch_<?php echo e($customer->id); ?>" <?php echo e($customer->status == 1 ? 'checked' : ''); ?> data-id="<?php echo e($customer->id); ?>" />
                                    <span class="modern-slider"></span>
                                </label>
                            </div>
                        </td>
                    <?php endif; ?>

                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.customers.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle mr-1"></i> <?php echo e(__('customers.no_customers_found')); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    <?php echo e($customers->links()); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/customers/partials/_table.blade.php ENDPATH**/ ?>