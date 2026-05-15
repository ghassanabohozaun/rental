<div class="modal modal-pop" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="<?php echo route('dashboard.maintenances.store'); ?>" method="POST" id='create_form' novalidate
            data-success-msg="<?php echo __('general.add_success_message'); ?>" data-success-action="reload-table" data-table-id="#table_data">
            <?php echo csrf_field(); ?>
            <div class="modal-content shadow-lg premium-modal-content">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="createModalLabel">
                        <i class="fas fa-plus-circle text-primary mr-2 icon-size-18"></i>
                        <?php echo __('maintenances.add_maintenance'); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <div class="row">
                        <!-- Company -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->company_id == 1): ?>
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="premium-label" for="company_id_create"><?php echo __('companies.company'); ?> <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control premium-input shadow-none js-select2"
                                        id='company_id_create' name="company_id" data-parent="#createModal">
                                        <option value=""><?php echo __('general.select_from_list'); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <span class="text-danger error-text company_id_error"></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Property -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="property_id_create"><?php echo __('maintenances.property'); ?> <span
                                        class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none js-select2 js-autocomplete"
                                    id="property_id_create" name="property_id" data-url="<?php echo route('dashboard.properties.autocomplete'); ?>"
                                    data-simple="true" data-placeholder="<?php echo __('general.select_from_list'); ?>"
                                    data-parent="#createModal" <?php echo e(user()->company_id == 1 ? 'disabled' : ''); ?>>
                                    <option value="" disabled selected></option>
                                </select>
                                <span class="text-danger error-text property_id_error"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="status_create"><?php echo __('maintenances.status'); ?> <span
                                        class="text-danger">*</span></label>
                                <select class="form-control premium-input shadow-none js-select2" id="status_create"
                                    name="status" data-parent="#createModal">
                                    <option value=""><?php echo __('general.select_from_list'); ?></option>
                                    <option value="pending"><?php echo __('maintenances.pending'); ?></option>
                                    <option value="in_progress"><?php echo __('maintenances.in_progress'); ?></option>
                                    <option value="done"><?php echo __('maintenances.done'); ?></option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="date_create"><?php echo __('maintenances.date'); ?></label>
                                <input type="text"
                                    class="form-control premium-input shadow-none text-left ptc-datepicker"
                                    id="date_create" name="date" placeholder="<?php echo __('maintenances.date'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text date_error"></span>
                            </div>
                        </div>

                        <!-- Cost -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="cost_create"><?php echo __('maintenances.cost'); ?></label>
                                <input type="number" step="0.01" class="form-control premium-input shadow-none"
                                    id="cost_create" name="cost" placeholder="<?php echo __('maintenances.cost'); ?>"
                                    autocomplete="off">
                                <span class="text-danger error-text cost_error"></span>
                            </div>
                        </div>

                        <!-- Description AR -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="description_ar_create"><?php echo __('maintenances.description'); ?>

                                    (<?php echo __('general.ar'); ?>)</label>
                                <textarea class="form-control premium-input shadow-none" id="description_ar_create" name="description_ar"
                                    rows="3" placeholder="<?php echo __('maintenances.description'); ?> (<?php echo __('general.ar'); ?>)"></textarea>
                                <span class="text-danger error-text description_ar_error"></span>
                            </div>
                        </div>

                        <!-- Description EN -->
                        <div class="col-md-6 mb-2">
                            <div class="premium-form-group">
                                <label class="premium-label" for="description_en_create"><?php echo __('maintenances.description'); ?>

                                    (<?php echo __('general.en'); ?>)</label>
                                <textarea class="form-control premium-input shadow-none" id="description_en_create" name="description_en"
                                    rows="3" placeholder="<?php echo __('maintenances.description'); ?> (<?php echo __('general.en'); ?>)"></textarea>
                                <span class="text-danger error-text description_en_error"></span>
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
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/maintenances/modals/create.blade.php ENDPATH**/ ?>