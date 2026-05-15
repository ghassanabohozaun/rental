<div>
    <div wire:ignore.self class="modal  premium-modal" id="quick-guarantor-modal" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="quick-guarantor-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="quick-guarantor-modal-label">
                        <?php echo e(__('guarantors.add_guarantor')); ?>

                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form wire:submit.prevent="saveQuickGuarantor">
                    <div class="modal-body py-3">
                        <div class="row rounded py-2 px-1 mx-0 border shadow-sm premium-quick-search-area"
                            style="margin-bottom: 11px !important;">
                            <div class="col-md-12">
                                <div class="premium-form-group mb-0">
                                    <label class="font-weight-bold text-primary">
                                        <?php echo __('guarantors.search_existing_guarantor'); ?></label>
                                    <div class="position-relative w-100">
                                        <input type="text" wire:model.live.debounce.300ms="searchTerm"
                                            class="form-control premium-input shadow-none"
                                            placeholder="<?php echo __('guarantors.search_by_id_name_phone'); ?>" autocomplete="off">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(strlen($searchTerm) > 0): ?>
                                            <div class="position-absolute w-100 mt-1" style="z-index: 9999;">
                                                <span
                                                    class="select2-container select2-container--default select2-container--open w-100">
                                                    <span class="select2-dropdown select2-dropdown--below"
                                                        dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">
                                                        <span class="select2-results">
                                                            <ul class="select2-results__options" role="listbox">
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($searchResults) > 0): ?>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="select2-results__option py-2 px-3"
                                                                            role="option"
                                                                            wire:click="selectGuarantor(<?php echo e($result['id']); ?>)"
                                                                            onmouseover="this.classList.add('select2-results__option--highlighted')"
                                                                            onmouseout="this.classList.remove('select2-results__option--highlighted')">
                                                                            <?php echo e(is_array($result['name']) ? $result['name'][app()->getLocale()] ?? $result['name']['en'] : $result['name']); ?>

                                                                            - <?php echo e($result['phone'] ?? ''); ?>

                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                <?php else: ?>
                                                                    <li class="select2-results__option select2-results__message"
                                                                        role="option">
                                                                        <?php echo e(__('guarantors.no_guarantors_found')); ?>

                                                                    </li>
                                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            </ul>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <small class="text-muted d-block mt-1"><?php echo __('guarantors.search_hint_or_add_new'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- Name AR -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.name_ar'); ?>

                                        <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.ar"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_name.ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_name_ar')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_name.ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <!-- Name EN -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.name_en'); ?>

                                        <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_name.en"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_name_en')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ID Number -->
                            <div class="col-md-6 mb-2">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.id_number'); ?> <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="quick_id_number"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_id_number')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6 mb-1">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.phone'); ?></label>
                                    <input type="text" wire:model.defer="quick_phone"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_phone')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Relationship -->
                            <div class="col-md-4 mb-1">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.relationship'); ?></label>
                                    <select wire:model.live="quick_relationship"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value=""><?php echo e(__('general.select_from_list')); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = __('guarantors.relationships'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($quick_relationship == self::RELATIONSHIP_OTHER): ?>
                                <!-- Relationship Details -->
                                <div class="col-md-8 mb-1">
                                    <div class="premium-form-group">
                                        <label class="font-weight-bold"><?php echo __('guarantors.relationship_details'); ?> <span
                                                class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="quick_relationship_details"
                                            class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_relationship_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="<?php echo e(__('guarantors.relationship_details')); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_relationship_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger error-text"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="row">
                            <!-- Address -->
                            <div class="col-md-12 mb-1">
                                <div class="premium-form-group">
                                    <label class="font-weight-bold"><?php echo __('guarantors.address'); ?></label>
                                    <input type="text" wire:model.defer="quick_address"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_address')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Notes -->
                            <div class="col-md-12 mb-0">
                                <div class="premium-form-group mb-0">
                                    <label class="font-weight-bold"><?php echo __('guarantors.notes'); ?></label>
                                    <input type="text" wire:model.defer="quick_notes"
                                        class="form-control premium-input shadow-none <?php $__errorArgs = ['quick_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('guarantors.enter_notes')); ?>"
                                        <?php echo e($is_existing ? 'readonly' : ''); ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['quick_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger error-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="submit"
                            class="btn btn-premium-save shadow-pulse px-4 font-weight-bold radius-10">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo e(__('guarantors.add_guarantor')); ?>

                            <i wire:loading wire:target="saveQuickGuarantor" class="fas fa-spinner fa-spin ml-1"></i>
                        </button>
                        <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold radius-10"
                            data-dismiss="modal">
                            <?php echo e(__('general.cancel')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/livewire/dashboard/customers/quick-guarantor-modal.blade.php ENDPATH**/ ?>