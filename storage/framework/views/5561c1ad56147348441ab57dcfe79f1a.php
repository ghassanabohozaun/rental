<input type="hidden" id="maintenances-total-count" value="<?php echo $maintenances->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo __('maintenances.property'); ?></th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('maintenances.date'); ?>

                </th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0"><?php echo __('maintenances.cost'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('maintenances.status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0" style="min-width: 150px;"><?php echo __('general.actions'); ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($maintenance->id); ?>">
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
                                        <div
                                            class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-indigo-alt">
                                            <i class="fas fa-tools font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo optional($maintenance->property)->name; ?></h4>

                                    <div class="modal-member-since-box">
                                        <i class="fas fa-calendar-alt small mr-1"></i>
                                        <?php echo __('general.created_at'); ?>: <?php echo is_string($maintenance->created_at) ? $maintenance->created_at : $maintenance->created_at->format('Y-m-d'); ?>

                                    </div>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $maintenance->id; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-building"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('maintenances.property'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($maintenance->property)->name ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('maintenances.date'); ?></span>
                                            <span class="detail-info-value"><?php echo $maintenance->date ?? '---'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('maintenances.cost'); ?></span>
                                            <span class="detail-info-value"><?php echo $maintenance->cost ?? '0.00'; ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($maintenance->company)->name ?? __('general.all_companies'); ?></span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('maintenances.status'); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php
                                                    $statusClass = 'badge-warning';
                                                    $statusText = __('maintenances.pending');
                                                    if ($maintenance->status == 'in_progress') {
                                                        $statusClass = 'badge-primary';
                                                        $statusText = __('maintenances.in_progress');
                                                    } elseif ($maintenance->status == 'done') {
                                                        $statusClass = 'badge-success';
                                                        $statusText = __('maintenances.done');
                                                    }
                                                ?>
                                                <span
                                                    class="badge badge-glow badge-pill px-2 <?php echo e($statusClass); ?>"><?php echo e($statusText); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo optional($maintenance->creator)->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($maintenances->currentPage() - 1) * $maintenances->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            <?php echo optional($maintenance->company)->name ?? __('general.all_companies'); ?>

                        </a>
                    </td>

                    <!-- Property -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold"><?php echo optional($maintenance->property)->name; ?></span>
                        </div>
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span
                            class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            <i class="fas fa-calendar-alt"></i> <?php echo $maintenance->date ?? '---'; ?>

                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-money-bill-wave text-muted mr-1"></i> <?php echo $maintenance->cost ?? '0.00'; ?>

                        </span>
                    </td>
                    <td class="text-center align-middle">
                        <?php
                            $statusClass = 'badge-warning';
                            $statusText = __('maintenances.pending');
                            if ($maintenance->status == 'in_progress') {
                                $statusClass = 'badge-primary';
                                $statusText = __('maintenances.in_progress');
                            } elseif ($maintenance->status == 'done') {
                                $statusClass = 'badge-success';
                                $statusText = __('maintenances.done');
                            }
                        ?>
                        <div class="badge badge-pill badge-glow maintenance_status_<?php echo $maintenance->id; ?> <?php echo e($statusClass); ?>"
                            style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
                            <?php echo e($statusText); ?>

                        </div>
                    </td>

                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.maintenances.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('maintenances.no_maintenances_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-right mt-2 custom-pagination">
    <?php echo $maintenances->links(); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/maintenances/partials/_table.blade.php ENDPATH**/ ?>