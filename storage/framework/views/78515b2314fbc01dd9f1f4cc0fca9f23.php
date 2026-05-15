<div class="modal modal-pop" id="createUserModal" role="dialog" aria-labelledby="createUserModalLabel" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="<?php echo route('dashboard.users.store'); ?>" method="POST" enctype="multipart/form-data"
            id='create_user_form' novalidate data-success-msg="<?php echo __('general.add_success_message'); ?>"
            data-success-action="reload-table" data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createUserModalLabel">
                        <i class="fas fa-user-plus text-primary mr-2 icon-size-18"></i>
                        <?php echo __('users.create_new_user'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <!-- First Row: Company (Full Width if Admin) -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($companies): ?>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <div class="premium-form-group">
                                <label class="premium-label" for="company_id_create"><?php echo __('companies.company'); ?> <span
                                        class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none select2"
                                    id='company_id_create' name="company_id">
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

                    <!-- Second Row: Names and Mobile (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_create"><?php echo __('users.name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="name_ar_create" name="name[ar]" placeholder="<?php echo __('users.enter_name_ar'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_create"><?php echo __('users.name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control premium-input shadow-none"
                                    id="name_en_create" name="name[en]" placeholder="<?php echo __('users.enter_name_en'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="mobile_create"><?php echo __('users.mobile'); ?></label>
                                <input type="text" class="form-control premium-input shadow-none text-left"
                                    id="mobile_create" name="mobile" placeholder="<?php echo __('users.enter_mobile'); ?>"
                                    dir="ltr" autocomplete="off">
                                <span class="text-danger error-text mobile_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row: Email, Password, Password Confirm (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="email_create"><?php echo __('users.email'); ?> <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control premium-input shadow-none text-left"
                                    id="email_create" name="email" placeholder="<?php echo __('users.enter_email'); ?>"
                                    dir="ltr" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="password_create"><?php echo __('users.password'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <i class="fas fa-eye pointer text-primary premium-icon-opposite"
                                        style="<?php echo e(Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;'); ?> position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_create', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none"
                                        id="password_create" name="password" placeholder="<?php echo __('users.enter_password'); ?>"
                                        autocomplete="new-password">
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="password_confirm_create"><?php echo __('users.password_confirm'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <i class="fas fa-eye pointer text-primary premium-icon-opposite"
                                        style="<?php echo e(Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;'); ?> position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_confirm_create', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none"
                                        id="password_confirm_create" name="password_confirm"
                                        placeholder="<?php echo __('users.enter_password_confirm'); ?>" autocomplete="new-password">
                                </div>
                                <span class="text-danger error-text password_confirm_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row: Role (Full Width) -->
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="role_id_create"><?php echo __('users.role_id'); ?> <span
                                        class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none select2" id='role_id_create'
                                    name="role_id">
                                    <option value="" selected=""><?php echo __('general.select_from_list'); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <span class="text-danger error-text role_id_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row: Photo (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="font-weight-bold text-dark"><?php echo __('users.photo'); ?></label>
                                <div class="premium-photo-container">
                                    <input type="file" name="photo" id="photo_create" class="form-control"
                                        accept="image/*">
                                </div>
                                <span class="text-danger error-text photo_error"></span>
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
    <script type="text/javascript">


        $(document).ready(function() {
            // Initialize Generic Select2 for Company & Role
            if ($('#company_id_create').length) {
                $('#company_id_create').select2({
                    dropdownParent: $('#createUserModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }
            if ($('#role_id_create').length) {
                $('#role_id_create').select2({
                    dropdownParent: $('#createUserModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }

            // Initialize FileInput using Global Generic Pattern
            window.PremiumFileInput.init("#photo_create");
        });
    </script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/users/modals/create.blade.php ENDPATH**/ ?>