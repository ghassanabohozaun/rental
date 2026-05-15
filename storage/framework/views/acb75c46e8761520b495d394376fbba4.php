<div class="modal modal-pop" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" id='edit_form' novalidate
            data-success-msg="<?php echo __('general.update_success_message'); ?>" data-success-action="reload-table" data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="editModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> <?php echo __('guarantors.edit_guarantor'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body mt-2 mb-0">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <!-- Company -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->company_id == 1): ?>
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="edit_company_id"><?php echo __('companies.company'); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none" id='edit_company_id'
                                        name="company_id">
                                        <option value=""><?php echo __('general.select_from_list'); ?></option>
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
                                <label class="premium-label" for="edit_name_ar"><?php echo __('guarantors.name'); ?> (<?php echo __('general.ar'); ?>) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="edit_name_ar" name="name[ar]"
                                    placeholder="<?php echo __('guarantors.name'); ?> (<?php echo __('general.ar'); ?>)"
                                    autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="edit_name_en"><?php echo __('guarantors.name'); ?> (<?php echo __('general.en'); ?>) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="edit_name_en" name="name[en]"
                                    placeholder="<?php echo __('guarantors.name'); ?> (<?php echo __('general.en'); ?>)"
                                    autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <!-- ID Number -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="edit_id_number"><?php echo __('guarantors.id_number'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="edit_id_number" name="id_number" placeholder="<?php echo __('guarantors.id_number'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text id_number_error"></span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="edit_phone"><?php echo __('guarantors.phone'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none text-left"
                                    id="edit_phone" name="phone" placeholder="<?php echo __('guarantors.phone'); ?>"
                                    dir="ltr" autocomplete="off">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="edit_address"><?php echo __('guarantors.address'); ?></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="edit_address" name="address" placeholder="<?php echo __('guarantors.address'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="edit_notes"><?php echo __('guarantors.notes'); ?></label>
                                <textarea class="form-control premium-input shadow-none" id="edit_notes" name="notes" rows="4"
                                    placeholder="<?php echo __('guarantors.notes'); ?>"></textarea>
                                <span class="text-danger error-text notes_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="submit" id="editSaveBtn"
                        class="btn btn-premium-save font-weight-bold">
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
            if ($('#edit_company_id').length) {
                $('#edit_company_id').select2({
                    dropdownParent: $('#editModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }


            // Handle edit button click
            $(document).on('click', '.js-edit-btn', function() {
                var id = $(this).data('id');
                var name_ar = $(this).data('name_ar');
                var name_en = $(this).data('name_en');
                var phone = $(this).data('phone');
                var id_number = $(this).data('id_number');
                var address = $(this).data('address');
                var notes = $(this).data('notes');
                var url = $(this).data('url');

                // Populate inputs
                $('#edit_id').val(id);
                $('#edit_name_ar').val(name_ar);
                $('#edit_name_en').val(name_en);
                $('#edit_phone').val(phone);
                $('#edit_id_number').val(id_number);
                $('#edit_address').val(address);
                $('#edit_notes').val(notes);

                // Set form action
                $('#edit_form').attr('action', url);

                // Handle Company Select2 for Super Admin
                <?php if(user()->company_id == 1): ?>
                    var company_id = $(this).data('company_id');
                    var select = $('#edit_company_id');
                    if (company_id) {
                        select.val(company_id).trigger('change');
                    } else {
                        select.val('').trigger('change');
                    }
                <?php endif; ?>
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/guarantors/modals/edit.blade.php ENDPATH**/ ?>