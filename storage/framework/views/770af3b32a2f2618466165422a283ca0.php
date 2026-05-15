<div class="modal modal-pop" id="createproperty_statusModal" tabindex="-1" role="dialog"
    aria-labelledby="createproperty_statusModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="<?php echo route('dashboard.property_statuses.store'); ?>" method="POST" enctype="multipart/form-data"
            id='create_property_status_form' novalidate data-success-msg="<?php echo __('general.add_success_message'); ?>"
            data-success-action="reload-table" data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="createproperty_statusModalLabel">
                        <i class="fas fa-plus-circle text-primary mr-2 icon-size-18"></i> <?php echo __('property_statuses.create_new_property_status'); ?>

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
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                            <div class="col-md-12 mb-2">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_dept_create"><?php echo __('property_statuses.company'); ?>

                                        <span class="text-danger">*</span></label>
                                    <select name="company_id" id="company_id_dept_create"
                                        class="form-control premium-input select2">
                                        <option value="" selected><?php echo e(__('general.select_from_list')); ?>

                                        </option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Name Arabic -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_ar_create"><?php echo __('property_statuses.name_ar'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_create" name="name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="<?php echo __('property_statuses.enter_name_ar'); ?>">
                                </div>
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Name English -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="name_en_create"><?php echo __('property_statuses.name_en'); ?> <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_create" name="name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="<?php echo __('property_statuses.enter_name_en'); ?>">
                                </div>
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <!-- Color -->
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="premium-label mb-3"><?php echo __('property_statuses.color'); ?> <span
                                        class="text-danger">*</span></label>

                                <div class="premium-color-selection-v2">
                                    <div class="color-options-row">
                                        <div class="color-chip active" style="--chip-color: #1e9ff2;"
                                            data-color="#1e9ff2" title="Blue"></div>
                                        <div class="color-chip" style="--chip-color: #666ee8;" data-color="#666ee8"
                                            title="Indigo"></div>
                                        <div class="color-chip" style="--chip-color: #28d094;" data-color="#28d094"
                                            title="Green"></div>
                                        <div class="color-chip" style="--chip-color: #ff9149;" data-color="#ff9149"
                                            title="Orange"></div>
                                        <div class="color-chip" style="--chip-color: #ff4961;" data-color="#ff4961"
                                            title="Red"></div>
                                        <div class="color-chip" style="--chip-color: #e91e63;" data-color="#e91e63"
                                            title="Pink"></div>
                                        <div class="color-chip" style="--chip-color: #9c27b0;" data-color="#9c27b0"
                                            title="Purple"></div>
                                        <div class="color-chip" style="--chip-color: #00bcd4;" data-color="#00bcd4"
                                            title="Cyan"></div>
                                        <div class="color-chip" style="--chip-color: #ffc107;" data-color="#ffc107"
                                            title="Amber"></div>
                                        <div class="color-chip" style="--chip-color: #8bc34a;" data-color="#8bc34a"
                                            title="Light Green"></div>
                                        <div class="color-chip" style="--chip-color: #009688;" data-color="#009688"
                                            title="Teal"></div>
                                        <div class="color-chip" style="--chip-color: #795548;" data-color="#795548"
                                            title="Brown"></div>
                                        <div class="color-chip" style="--chip-color: #607d8b;" data-color="#607d8b"
                                            title="Blue Gray"></div>
                                        <div class="color-chip" style="--chip-color: #323232;" data-color="#323232"
                                            title="Dark"></div>
                                        <div class="color-chip" style="--chip-color: #babfc7;" data-color="#babfc7"
                                            title="Gray"></div>

                                        <div class="advanced-picker-trigger" id="advancedPickerBtn"
                                            title="Custom Color">
                                            <i class="fas fa-cog"></i>
                                            <input type="color" id="color_create_picker" value="#1e9ff2"
                                                class="d-none">
                                        </div>
                                    </div>

                                    <div class="selected-color-info mt-3 d-flex align-items-center">
                                        <div class="color-preview-circle" id="colorPreview_create"></div>
                                        <input type="text" id="color_create" name="color"
                                            class="premium-hex-display" value="#1e9ff2" readonly>
                                        <small class="text-muted ml-2">(<?php echo e(__('general.selected_color')); ?>)</small>
                                    </div>
                                    <span class="text-danger error-text color_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
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
            if ($('#company_id_dept_create').length) {
                $('#company_id_dept_create').select2({
                    dropdownParent: $('#createproperty_statusModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }

            // Premium Color Picker Logic V2
            function updateColor_create(color) {
                $('#color_create').val(color);
                $('#color_create_picker').val(color);
                $('#colorPreview_create').css('background-color', color);

                // Highlight active chip
                $('.color-chip').removeClass('active');
                $(`.color-chip[data-color="${color.toLowerCase()}"]`).addClass('active');
            }

            // When advanced picker changes
            $('#color_create_picker').on('input', function() {
                updateColor_create($(this).val());
            });

            // When a chip is clicked
            $('.color-chip').on('click', function() {
                updateColor_create($(this).data('color'));
            });

            // When trigger is clicked, open hidden picker
            $('#advancedPickerBtn').on('click', function() {
                $('#color_create_picker').click();
            });

            // Set initial state
            updateColor_create('#1e9ff2');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_statuses/modals/create.blade.php ENDPATH**/ ?>