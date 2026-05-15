<div class="content-wrapper">

    <!-- begin: content header -->
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo route('dashboard.index'); ?>"><i class="fas fa-home"></i>
                                <?php echo __('dashboard.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo route('dashboard.customers.index'); ?>"><?php echo __('customers.customers'); ?></a></li>
                        <li class="breadcrumb-item active font-weight-bold"><?php echo __('customers.add_customer'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="<?php echo route('dashboard.customers.index'); ?>" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> <?php echo __('general.back'); ?>

                </a>
                <button type="button" wire:click="store" class="btn btn-premium-save shadow-pulse">
                    <i class="fas fa-save"></i> <?php echo __('general.save'); ?>

                    <span wire:loading wire:target="store" class="fas fa-sync fa-spin ml-1"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- end :content header -->

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card premium-card mb-2 premium-card-anim">
                    <div class="premium-mandatory-header py-2 border-bottom-0">
                        <div class="font-weight-bold text-dark"><?php echo __('customers.personal_info'); ?></div>
                    </div>
                    <div class="card-body">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->company_id == 1): ?>
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <div class="premium-form-group">
                                        <label class="premium-label"><?php echo __('companies.company'); ?> <span
                                                class="text-danger">*</span></label>
                                        <div wire:ignore>
                                            <select id="company_id_header" wire:model.defer="company_id"
                                                class="form-control premium-input shadow-none select2 <?php $__errorArgs = ['company_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value=""><?php echo __('general.select_company'); ?></option>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </select>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company_id'];
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
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <div class="premium-form-group">
                                    <label class="premium-label"><?php echo __('customers.tenant_type'); ?> <span
                                            class="text-danger">*</span></label>
                                    <div wire:ignore>
                                        <select id="tenant_type" wire:model.live="tenant_type"
                                            class="form-control premium-input shadow-none select2 <?php $__errorArgs = ['tenant_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value=""><?php echo __('customers.select_tenant_type'); ?></option>
                                            <option value="individual"><?php echo __('customers.individual'); ?></option>
                                            <option value="company"><?php echo __('customers.company'); ?></option>
                                        </select>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tenant_type'];
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant_type): ?>
                            <div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tenant_type == 'company'): ?>
                                    <div class="row mt-1 animate__animated animate__fadeIn">
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label"><?php echo __('customers.customer_company_name'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="company_name"
                                                    class="form-control premium-input shadow-none <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo __('customers.customer_company_name'); ?>">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company_name'];
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
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label"><?php echo __('customers.establishment_number'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="establishment_number"
                                                    class="form-control premium-input shadow-none <?php $__errorArgs = ['establishment_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo __('customers.establishment_number'); ?>">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['establishment_number'];
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
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label"><?php echo __('customers.cr_number'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="cr_number"
                                                    class="form-control premium-input shadow-none <?php $__errorArgs = ['cr_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo __('customers.cr_number'); ?>">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cr_number'];
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
                                        <div class="col-md-3">
                                            <div class="premium-form-group">
                                                <label class="premium-label"><?php echo __('customers.license_number'); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" wire:model.defer="license_number"
                                                    class="form-control premium-input shadow-none <?php $__errorArgs = ['license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo __('customers.license_number'); ?>">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['license_number'];
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
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.name_ar'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="name.ar"
                                                class="form-control premium-input shadow-none <?php $__errorArgs = ['name.ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo __('customers.name_ar'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name.ar'];
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
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.name_en'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="name.en"
                                                class="form-control premium-input shadow-none <?php $__errorArgs = ['name.en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo __('customers.name_en'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name.en'];
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
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.phone'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="phone"
                                                class="form-control premium-input shadow-none text-left <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                dir="ltr" placeholder="<?php echo __('customers.phone'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
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
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.id_number'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="id_number"
                                                class="form-control premium-input shadow-none <?php $__errorArgs = ['id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo __('customers.id_number'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_number'];
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

                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.nationality'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore
                                                wire:key="nationality-select-wrapper-<?php echo e($tenant_type); ?>">
                                                <select id="nationality_id" wire:model.defer="nationality_id"
                                                    class="form-control premium-input shadow-none select2 <?php $__errorArgs = ['nationality_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <option value=""><?php echo __('general.select_from_list'); ?></option>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($nationality->id); ?>">
                                                            <?php echo e($nationality->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </select>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nationality_id'];
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
                                    <div class="col-md-3">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.email'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" wire:model.defer="email"
                                                class="form-control premium-input shadow-none text-left <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                dir="ltr" placeholder="<?php echo __('customers.email'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
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
                                    <div class="col-md-6">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('customers.address'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="address"
                                                class="form-control premium-input shadow-none <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid-premium <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo __('customers.address'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
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
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Section 2: Guarantors (Repeater) -->
            <div class="col-12">
                <div class="card premium-card mb-2 <?php $__errorArgs = ['customer_guarantors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> premium-card-error-glow pulse-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    wire:key="guarantors-card-wrapper-<?php echo e($validation_fail_nonce); ?>">
                    <div
                        class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center">
                        <div class="font-weight-bold text-dark"><?php echo __('customers.guarantors'); ?></div>
                        <div class="text-center">
                            <button type="button" wire:click="openGuarantorModal" class="btn-premium-add-guarantor"
                                title="<?php echo e(__('guarantors.add_guarantor')); ?>">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 pb-3">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light-primary-opacity">
                                    <tr>
                                        <th class="align-middle py-3 border-top-0">
                                            <?php echo __('guarantors.name_ar'); ?></th>
                                        <th class="align-middle py-3 border-top-0">
                                            <?php echo __('guarantors.name_en'); ?></th>
                                        <th class="align-middle py-3 border-top-0">
                                            <?php echo __('customers.id_number'); ?></th>
                                        <th class="align-middle py-3 border-top-0">
                                            <?php echo __('customers.phone'); ?></th>
                                        <th class="align-middle py-3 border-top-0 text-center">
                                            <?php echo __('guarantors.relationship'); ?></th>
                                        <th class="align-middle py-3 border-top-0 text-center">
                                            <i class="fas fa-trash-alt header-trash-icon"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customer_guarantors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $guarantor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="owner-row" wire:key="guarantor-row-<?php echo e($index); ?>">
                                            <!-- Name AR -->
                                            <td class="align-middle">
                                                <div class="user-info-cell">
                                                    <span class="user-name-text">
                                                        <?php echo e($guarantor['name_ar'] ?: '---'); ?>

                                                    </span>
                                                </div>
                                            </td>
                                            <!-- Name EN -->
                                            <td class="align-middle">
                                                <span class="text-muted small">
                                                    <?php echo e($guarantor['name_en'] ?: '---'); ?>

                                                </span>
                                            </td>
                                            <!-- ID Number -->
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-bold">
                                                    <?php echo e($guarantor['id_number'] ?: '---'); ?>

                                                </span>
                                            </td>
                                            <!-- Phone -->
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-bold text-left ltr-text">
                                                    <?php echo e($guarantor['phone'] ?? '---'); ?>

                                                </span>
                                            </td>
                                            <!-- Relationship -->
                                            <td class="align-middle text-center">
                                                <?php
                                                    $relKey = $guarantor['relationship'] ?? '';
                                                    $relName = __('guarantors.relationships.' . $relKey);
                                                    if (strpos($relName, 'guarantors.relationships') !== false) {
                                                        $relName = $relKey;
                                                    }
                                                ?>
                                                <span
                                                    class="badge badge-light-info-opacity text-info badge-pill border-0 px-2 font-weight-bold">
                                                    <?php echo e($relName ?: '---'); ?>

                                                </span>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($guarantor['relationship'] ?? '') == 10 && !empty($guarantor['relationship_details'])): ?>
                                                    <div class="small text-muted mt-1">
                                                        (<?php echo e($guarantor['relationship_details']); ?>)
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                            <!-- Actions -->
                                            <td class="align-middle text-center">
                                                <button type="button"
                                                    wire:click="removeGuarantor(<?php echo e($index); ?>)"
                                                    class="btn-premium-action btn-premium-action-danger remove-guarantor-btn shadow-none btn-trash-cell">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center p-3 text-dark font-weight-bold">
                                                <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                <?php echo __('customers.no_guarantors_added'); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customer_guarantors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger p-2 font-weight-bold small animated headShake text-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Row 4: Notes -->
            <div class="col-12">
                <div class="card premium-card mb-2 premium-card-anim">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="premium-form-group mb-0">
                                    <label class="premium-label"><?php echo __('customers.notes'); ?></label>
                                    <textarea wire:model.defer="notes" class="form-control premium-input shadow-none" rows="5"
                                        placeholder="<?php echo __('customers.notes'); ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('dashboard.customers.quick-guarantor-modal', ['parentCompanyId' => $company_id,'parent_company_id' => $company_id]);

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1134891980-0', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('close-modal', event => {
            $('#' + event.detail).modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#' + event.detail).modal('show');
        });
    </script>
    <script src="<?php echo e(asset('assets/dashbaord/js/generic-select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            function initSelects() {
                $('.select2:not(.ajax-select)').each(function() {
                    let $this = $(this);
                    let model = $this.attr('wire:model.defer') || $this.attr('wire:model.lazy') || $this
                        .attr('wire:model.live') || $this.attr('wire:model');

                    $this.select2({
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr',
                        dropdownParent: $this.parent()
                    }).on('change', function(e) {
                        if (model) {
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set(model, e.target.value);
                        }
                    });
                });
            }

            initSelects();

            // Targeted listener for guarantor updates
            Livewire.on('guarantorUpdated', (data) => {
                let index = data[0].index;
                let companyId = data[0].company_id;
                let $companySelect = $('#company_select_' + index);

                if ($companySelect.length) {
                    $companySelect.val(companyId).trigger('change');
                    $companySelect.trigger('change.select2');
                }
            });

            window.addEventListener('reinitSelect2', event => {
                setTimeout(() => {
                    initSelects();
                }, 50);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/livewire/dashboard/customers/create-customer.blade.php ENDPATH**/ ?>