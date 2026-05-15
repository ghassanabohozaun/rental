<div class="modal modal-pop" id="updateproperty_typeModal" tabindex="-1" role="dialog"
    aria-labelledby="updateproperty_typeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data"
            id='update_property_type_form' data-success-msg="<?php echo __('general.update_success_message'); ?>" data-success-action="reload-table"
            data-table-id="#table_data" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="updateproperty_typeModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> <?php echo __('property_types.update_property_type'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body mt-2 mb-0">
                    <div class="row">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                            <div class="col-md-12 mb-2">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_dept_edit"><?php echo __('companies.company'); ?>

                                        <span class="text-danger">*</span></label>
                                    <select class="form-control premium-input select2 shadow-none"
                                        id='company_id_dept_edit' name="company_id">
                                        <option value="" selected><?php echo __('general.select_from_list'); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <input type="hidden" id="id_edit" name="id">

                        <!-- Name Arabic -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_edit"><?php echo __('property_types.name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_edit" name="name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="<?php echo __('property_types.enter_name_ar'); ?>">
                                </div>
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name English -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_edit"><?php echo __('property_statuses.name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_edit" name="name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="<?php echo __('property_types.enter_name_en'); ?>">
                                </div>
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="submit" id="saveBtnEdit" class="btn btn-premium-save font-weight-bold">
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
    <script type="text/javascript">
        $(document).ready(function() {
            // Show edit modal and populate data dynamically
            $('body').on('click', '.edit_property_type_button', function(e) {
                e.preventDefault();

                let property_type_id = $(this).attr('property_type-id');
                let property_type_name_ar = $(this).attr('property_type-name-ar');
                let property_type_name_en = $(this).attr('property_type-name-en');
                let property_type_company_id = $(this).attr('property_type-company-id');
                let property_type_company_name = $(this).attr('property_type-company-name');

                // Populate form fields
                $('#id_edit').val(property_type_id);
                $('#name_ar_edit').val(property_type_name_ar);
                $('#name_en_edit').val(property_type_name_en);

                // Populate Select2 for Company
                if ($('#company_id_dept_edit').length) {
                    $('#company_id_dept_edit').val(property_type_company_id).trigger('change');
                }

                // Update form action URL dynamically
                let url = "<?php echo route('dashboard.property_types.update', 'id'); ?>".replace('id', property_type_id);
                $('#update_property_type_form').attr('action', url);

                // Show modal
                $('#updateproperty_typeModal').modal('show');
            });

            // Initialize Select2
            if ($('#company_id_dept_edit').length) {
                $('#company_id_dept_edit').select2({
                    dropdownParent: $('#updateproperty_typeModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_types/modals/edit.blade.php ENDPATH**/ ?>