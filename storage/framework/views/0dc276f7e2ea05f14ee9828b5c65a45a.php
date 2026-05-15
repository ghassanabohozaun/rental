<div class="modal modal-pop" id="createBankAccountModal" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="createBankAccountModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="<?php echo route('dashboard.bank-accounts.store'); ?>" method="POST" enctype="multipart/form-data"
            id='create_bank_account_form' novalidate data-success-msg="<?php echo __('general.add_success_message'); ?>"
            data-success-action="reload-table" data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <div class="modal-content shadow-lg premium-modal-content">
                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="createBankAccountModalLabel">
                        <i class="fas fa-plus-circle text-primary mr-2 icon-size-18"></i> <?php echo __('bank_accounts.create_new_bank_account'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_bank_create"><?php echo __('companies.company'); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none select2"
                                        id='company_id_bank_create' name="company_id">
                                        <option value=""><?php echo __('general.select_from_list'); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="row">
                        <!-- Bank Name Arabic -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="bank_name_ar_create"><?php echo __('bank_accounts.bank_name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="bank_name_ar_create" name="bank_name[ar]"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('bank_accounts.enter_bank_name_ar'); ?>">
                                <span class="text-danger error-text bank_name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Bank Name English -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="bank_name_en_create"><?php echo __('bank_accounts.bank_name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="bank_name_en_create" name="bank_name[en]"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('bank_accounts.enter_bank_name_en'); ?>">
                                <span class="text-danger error-text bank_name_en_error"></span>
                            </div>
                        </div>

                        <!-- Account Holder Arabic -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="account_holder_name_ar_create"><?php echo __('bank_accounts.account_holder_name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="account_holder_name_ar_create"
                                    name="account_holder_name[ar]" class="form-control premium-input shadow-none"
                                    autocomplete="off" placeholder="<?php echo __('bank_accounts.enter_account_holder_name_ar'); ?>">
                                <span class="text-danger error-text account_holder_name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Account Holder English -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="account_holder_name_en_create"><?php echo __('bank_accounts.account_holder_name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="account_holder_name_en_create"
                                    name="account_holder_name[en]" class="form-control premium-input shadow-none"
                                    autocomplete="off" placeholder="<?php echo __('bank_accounts.enter_account_holder_name_en'); ?>">
                                <span class="text-danger error-text account_holder_name_en_error"></span>
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="account_number_create"><?php echo __('bank_accounts.account_number'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="account_number_create" name="account_number"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('bank_accounts.enter_account_number'); ?>">
                                <span class="text-danger error-text account_number_error"></span>
                            </div>
                        </div>

                        <!-- IBAN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="iban_create"><?php echo __('bank_accounts.iban'); ?></label>
                                <input type="text" id="iban_create" name="iban"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('bank_accounts.enter_iban'); ?>">
                                <span class="text-danger error-text iban_error"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="is_default_create" class="premium-switch-container"
                                style="display: flex !important; justify-content: space-between !important; align-items: center !important; flex-direction: row !important; width: 100% !important;">
                                <div class="premium-switch-content"
                                    style="display: flex !important; align-items: center !important; gap: 1rem !important;">
                                    <div class="premium-switch-icon-circle text-warning shadow-sm">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="premium-switch-texts">
                                        <h6 class="premium-switch-title mb-1"><?php echo __('bank_accounts.is_default'); ?></h6>
                                        <span class="premium-switch-subtitle"><?php echo __('bank_accounts.set_as_default'); ?></span>
                                    </div>
                                </div>
                                <label class="modern-switch" style="flex-shrink: 0 !important;">
                                    <input type="checkbox" id="is_default_create" name="is_default">
                                    <span class="modern-slider"></span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0 premium-modal-footer mt-3">
                    <button type="submit" id="saveBtn" class="btn btn-premium-save font-weight-bold">
                        <i class="fas fa-save mr-2"></i>
                        <i class="fas fa-spinner fa-spin d-none spinner_loading mr-2"></i>
                        <?php echo e(__('general.save')); ?>

                    </button>

                    <button type="button" class="btn btn-premium-secondary font-weight-bold"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-2"></i> <?php echo e(__('general.cancel')); ?>

                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            if ($('#company_id_bank_create').length) {
                $('#company_id_bank_create').select2({
                    dropdownParent: $('#createBankAccountModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/bank_accounts/modals/create.blade.php ENDPATH**/ ?>