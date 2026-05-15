<input type="hidden" id="companies-total-count" value="<?php echo $companies->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id="myTable">
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('companies.logo'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.company_name'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('companies.email'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('companies.created_by'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell"><?php echo __('companies.phone'); ?>

                </th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.manage_status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($company->id); ?>">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <?php echo $__env->make('dashboard.companies.parts.logo', ['size' => 100], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $company->name; ?></h4>
                                    <span class="modal-role-badge"><?php echo __('companies.plan_' . strtolower($company->subscription_plan)); ?></span>
                                </div>

                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.created_by'); ?></span>
                                            <span class="detail-info-value text-muted"><?php echo $company->creator->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.email'); ?></span>
                                            <span class="detail-info-value text-muted"><?php echo $company->email ?? '---'; ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-phone"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.phone'); ?></span>
                                            <span class="detail-info-value text-muted"><?php echo $company->phone ?? '---'; ?></span>
                                        </div>
                                    </div>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.address'); ?></span>
                                            <span class="detail-info-value text-muted"><?php echo $company->address ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage(); ?>

                        </span>
                    </td>

                    <!-- Logo -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <?php echo $__env->make('dashboard.companies.parts.logo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    <!-- Name -->
                    <td class="text-center align-middle">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            <?php echo $company->name; ?>

                        </a>
                    </td>

                    <!-- Email -->
                    <td class="text-center align-middle d-none d-lg-table-cell"><?php echo $company->email ?? '---'; ?></td>

                    <!-- Created By -->
                    <td class="text-center align-middle d-none d-lg-table-cell"><?php echo $company->creator->name ?? '---'; ?></td>

                    <!-- Phone (XL and above) -->
                    <td class="text-center align-middle d-none d-xl-table-cell"><?php echo $company->phone ?? '---'; ?></td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.companies.parts.status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    <!-- Manage Status -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.companies.parts.manage_status', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.companies.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('companies.no_companies_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
    <div class="float-right mt-2 custom-pagination">
        <?php echo $companies->links(); ?>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/partials/_table.blade.php ENDPATH**/ ?>