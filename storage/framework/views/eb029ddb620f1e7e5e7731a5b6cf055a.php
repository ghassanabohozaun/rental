<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="<?php echo route('dashboard.owners.store'); ?>" method="POST"
            id='create_form' novalidate
            data-success-msg="<?php echo __('general.add_success_message'); ?>"
            data-success-action="reload-table"
            data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <div class="modal-content premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-user-plus text-primary mr-2 icon-size-18"></i> <?php echo __('owners.add_owner'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body mt-2 mb-0">
                    <div class="row">
                        <!-- Company -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->company_id == 1): ?>
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_create"><?php echo __('companies.company'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none select2" id='company_id_create' name="company_id">
                                        <option value="" selected><?php echo __('general.select_from_list'); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Name AR -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_create"><?php echo __('owners.name'); ?> (<?php echo __('general.ar'); ?>) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_ar_create"
                                    name="name[ar]" placeholder="<?php echo __('owners.name'); ?> (<?php echo __('general.ar'); ?>)" autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_create"><?php echo __('owners.name'); ?> (<?php echo __('general.en'); ?>) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="name_en_create"
                                    name="name[en]" placeholder="<?php echo __('owners.name'); ?> (<?php echo __('general.en'); ?>)" autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="type_create"><?php echo __('owners.type'); ?> <span class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none select2" id="type_create" name="type">
                                    <option value="" selected><?php echo __('general.select_from_list'); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = __('owners.owner_types'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <!-- Identification Number -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="identification_number_create"><?php echo __('owners.identification_number'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none" id="identification_number_create"
                                    name="identification_number" placeholder="<?php echo __('owners.identification_number'); ?>" autocomplete="off">
                                <span class="text-danger error-text identification_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="phone_create"><?php echo __('owners.phone'); ?></label>
                                <input type="text" class="form-control premium-input shadow-none text-left" id="phone_create"
                                    name="phone" placeholder="<?php echo __('owners.phone'); ?>" dir="ltr" autocomplete="off">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="email_create"><?php echo __('owners.email'); ?></label>
                                <input type="email" class="form-control premium-input shadow-none" id="email_create"
                                    name="email" placeholder="<?php echo __('owners.email'); ?>" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="address_create"><?php echo __('owners.address'); ?></label>
                                <input type="text" class="form-control premium-input shadow-none" id="address_create"
                                    name="address" placeholder="<?php echo __('owners.address'); ?>" autocomplete="off">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="notes_create"><?php echo __('owners.notes'); ?></label>
                                <textarea class="form-control premium-input shadow-none" id="notes_create" name="notes" rows="4" placeholder="<?php echo __('owners.notes'); ?>"></textarea>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0 premium-modal-footer">
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
        if ($('#company_id_create').length) {
            $('#company_id_create').select2({
                dropdownParent: $('#createModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        if ($('#type_create').length) {
            $('#type_create').select2({
                dropdownParent: $('#createModal'),
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });
        }
        // Clear state on input
        $(document).on('input change', '#create_form .premium-input, #create_form select', function() {
            const $wrapper = $(this).closest('.premium-input-wrapper');
            if ($wrapper.hasClass('is-invalid-premium')) {
                $wrapper.removeClass('is-invalid-premium');
                // Handle Select2
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid-premium');
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/owners/modals/create.blade.php ENDPATH**/ ?>