<div class="modal modal-pop" id="updateDepartmentModal" tabindex="-1" role="dialog"
    aria-labelledby="updateDepartmentModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data"
            id='update_department_form' data-success-msg="<?php echo __('general.update_success_message'); ?>" data-success-action="reload-table"
            data-table-id="#table_data" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="updateDepartmentModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> <?php echo __('departments.update_department'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label class="premium-label" for="company_id_dept_edit"><?php echo __('companies.company'); ?> <span class="text-danger">*</span></label>
                                <select class="form-control premium-input select2 shadow-none" id='company_id_dept_edit' name="company_id">
                                    <option value="" selected><?php echo __('general.select_from_list'); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <span class="text-danger error-text company_id_error"></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="row">
                        <input type="hidden" id="id_edit" name="id">

                        <!-- Name Arabic -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_edit"><?php echo __('departments.name_ar'); ?> <span class="text-danger">*</span></label>
                                <input type="text" id="name_ar_edit" name="name[ar]"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('departments.enter_name_ar'); ?>">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name English -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_edit"><?php echo __('departments.name_en'); ?> <span class="text-danger">*</span></label>
                                <input type="text" id="name_en_edit" name="name[en]"
                                    class="form-control premium-input shadow-none" autocomplete="off"
                                    placeholder="<?php echo __('departments.enter_name_en'); ?>">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

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
            $('body').on('click', '.edit_department_button', function(e) {
                e.preventDefault();
                
                let department_id = $(this).attr('department-id');
                let department_name_ar = $(this).attr('department-name-ar');
                let department_name_en = $(this).attr('department-name-en');
                let department_company_id = $(this).attr('department-company-id');
                let department_company_name = $(this).attr('department-company-name');

                // Populate form fields
                $('#id_edit').val(department_id);
                $('#name_ar_edit').val(department_name_ar);
                $('#name_en_edit').val(department_name_en);

                // Populate Select2 for Company
                if ($('#company_id_dept_edit').length) {
                    if (department_company_id) {
                        $('#company_id_dept_edit').val(department_company_id).trigger('change');
                    } else {
                        $('#company_id_dept_edit').val(null).trigger('change');
                    }
                }

                // Update form action URL dynamically
                let url = "<?php echo route('dashboard.departments.update', 'id'); ?>".replace('id', department_id);
                $('#update_department_form').attr('action', url);
                
                // Show modal
                $('#updateDepartmentModal').modal('show');
            });

            // Initialize Select2
            if ($('#company_id_dept_edit').length) {
                $('#company_id_dept_edit').select2({
                    dropdownParent: $('#updateDepartmentModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/departments/modals/edit.blade.php ENDPATH**/ ?>