<input type="hidden" id="bank_accounts-total-count" value="<?php echo $bankAccounts->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0">#</th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('companies.company'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('bank_accounts.bank_name'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('bank_accounts.account_number'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell"><?php echo __('bank_accounts.account_holder_name'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('bank_accounts.is_default'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('departments.created_by'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($account->id); ?>">
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
                                            <i class="fas fa-university font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $account->bank_name; ?></h4>
                                    <span class="modal-role-badge"><?php echo $account->account_number; ?></span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('general.system_id'); ?></span>
                                            <span class="detail-info-value text-muted"># <?php echo $account->id; ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('bank_accounts.account_holder_name'); ?></span>
                                            <span class="detail-info-value text-muted"><?php echo $account->account_holder_name; ?></span>
                                        </div>
                                    </div>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($account->iban): ?>
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-barcode"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('bank_accounts.iban'); ?></span>
                                            <span class="detail-info-value text-muted" dir="ltr"><?php echo $account->formatted_iban; ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('companies.company'); ?></span>
                                            <span class="detail-info-value text-muted small">
                                                <span class="badge badge-light-primary border-0"><?php echo $account->company->name ?? '---'; ?></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-star"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('bank_accounts.is_default'); ?></span>
                                            <div class="detail-info-value mt-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($account->is_default): ?>
                                                    <span class="badge badge-success badge-glow badge-pill px-2"><?php echo __('bank_accounts.is_default'); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">---</span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('departments.created_by'); ?></span>
                                            <span class="detail-info-value"><?php echo $account->creator->name ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($bankAccounts->currentPage() - 1) * $bankAccounts->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <td class="text-center align-middle">
                        <a href="javascript:void(0)" class="company-chip">
                            <i class="fas fa-briefcase mr-1"></i>
                            <?php echo $account->company->name ?? '---'; ?>

                        </a>
                    </td>

                    <!-- Bank Name -->
                    <td class="text-center align-middle font-weight-bold text-primary"><?php echo $account->bank_name; ?></td>
                    
                    <!-- Account Number -->
                    <td class="text-center align-middle font-weight-bold" dir="ltr"><?php echo $account->account_number; ?></td>
                    
                    <!-- Account Holder -->
                    <td class="text-center align-middle d-none d-xl-table-cell"><?php echo $account->account_holder_name; ?></td>
                    
                    <!-- Is Default -->
                    <td class="text-center align-middle">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($account->is_default): ?>
                            <i class="fas fa-star text-warning font-large-1" title="<?php echo __('bank_accounts.is_default'); ?>"></i>
                        <?php else: ?>
                            <i class="fas fa-star-o text-muted font-large-1"></i>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-muted small"><?php echo $account->creator->name ?? '---'; ?></span>
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        <?php echo $__env->make('dashboard.bank_accounts.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="ft-info mr-1"></i> <?php echo __('bank_accounts.no_bank_accounts_found'); ?>

                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        <?php echo $bankAccounts->links(); ?>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/bank_accounts/partials/_table.blade.php ENDPATH**/ ?>