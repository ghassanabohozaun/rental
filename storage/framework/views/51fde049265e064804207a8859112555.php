<div class="content-wrapper">



    <!-- begin: content header -->
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo route('dashboard.index'); ?>"><i class="fas fa-home"></i>
                                <?php echo __('dashboard.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo route('dashboard.properties.index'); ?>"><?php echo __('properties.properties'); ?></a></li>
                        <li class="breadcrumb-item active font-weight-bold"><?php echo __('properties.create_new_property'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="<?php echo route('dashboard.properties.index'); ?>" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> <?php echo __('general.back'); ?>

                </a>
                <button type="button" wire:click="store" class="btn btn-premium-save">
                    <i wire:loading.remove wire:target="store" class="fas fa-save mr-2"></i>
                    <i wire:loading wire:target="store" class="fas fa-sync fa-spin mr-2"></i>
                    <?php echo __('general.save'); ?>

                </button>
            </div>
        </div>
    </div>
    <!-- end :content header -->

    <!-- begin: content body -->
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <!-- Main Container for all sections -->
                <div class="col-12">
                    <!-- Section 1: Basic Information -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0">
                            <div class="font-weight-bold text-dark"><?php echo __('properties.basic_info'); ?></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Row 1: Company Selection (Admin Only) -->
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(user()->company_id == 1): ?>
                                    <div class="col-md-12 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('companies.company'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore class="<?php if($errors->has('company_id')): ?> is-invalid-premium <?php endif; ?>">
                                                <select id="company_id" wire:model.defer="company_id"
                                                    class="form-control premium-input shadow-none select2">
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
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <!-- Row 2: Dependency, Name AR, Name EN, Description -->
                                <!-- Row 1: Identity & File -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.parent_property'); ?></label>
                                            <div wire:ignore class="<?php if($errors->has('parent_id')): ?> is-invalid-premium <?php endif; ?>">
                                                <select id="parent_id" wire:model.defer="parent_id"
                                                    data-simple="true"
                                                    class="form-control premium-input shadow-none select2 ajax-select">
                                                    <option value=""><?php echo __('properties.standalone_property'); ?></option>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $parent_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </select>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['parent_id'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.name_ar'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper <?php if($errors->has('name.ar')): ?> is-invalid-premium <?php endif; ?>">
                                                <input type="text" wire:model.defer="name.ar"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="<?php echo __('properties.enter_name_ar'); ?>">

                                            </div>
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.name_en'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper <?php if($errors->has('name.en')): ?> is-invalid-premium <?php endif; ?>">
                                                <input type="text" wire:model.defer="name.en"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="<?php echo __('properties.enter_name_en'); ?>">

                                            </div>
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.file_number'); ?></label>
                                            <div
                                                class="premium-input-wrapper <?php if($errors->has('file_number')): ?> is-invalid-premium <?php endif; ?>">
                                                <input type="text" wire:model.defer="file_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="<?php echo __('properties.enter_file_number'); ?>">

                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['file_number'];
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

                                <!-- Row 2: Categorization & Description -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.type'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore class="<?php if($errors->has('property_type_id')): ?> is-invalid-premium <?php endif; ?>">
                                                <select wire:model.defer="property_type_id"
                                                    class="form-control premium-input shadow-none select2"
                                                    id="property_type_id">
                                                    <option value=""><?php echo __('general.select_from_list'); ?></option>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $property_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </select>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_type_id'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.status'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore class="<?php if($errors->has('property_status_id')): ?> is-invalid-premium <?php endif; ?>">
                                                <select wire:model.defer="property_status_id"
                                                    class="form-control premium-input shadow-none select2"
                                                    id="property_status_id">
                                                    <option value=""><?php echo __('general.select_from_list'); ?></option>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </select>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_status_id'];
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
                                    <div class="col-xl-6 col-lg-12 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.description'); ?></label>
                                            <input type="text" wire:model.defer="description"
                                                class="form-control premium-input shadow-none <?php if($errors->has('description')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_description'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
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

                                <!-- Row 3: Financial & Location -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.price'); ?></label>
                                            <input type="number" step="0.01" wire:model.defer="price"
                                                class="form-control premium-input shadow-none <?php if($errors->has('price')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_price'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['price'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.area'); ?></label>
                                            <input type="number" step="0.01" wire:model.defer="area"
                                                class="form-control premium-input shadow-none <?php if($errors->has('area')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_area'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['area'];
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
                                    <div class="col-xl-6 col-lg-12 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.location'); ?></label>
                                            <input type="text" wire:model.defer="location"
                                                class="form-control premium-input shadow-none <?php if($errors->has('location')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_location'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['location'];
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

                                <!-- Row 4: Technical Numbers -->
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.property_number'); ?></label>
                                            <input type="text" wire:model.defer="property_number"
                                                class="form-control premium-input shadow-none <?php if($errors->has('property_number')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_property_number'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_number'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.title_deed_number'); ?></label>
                                            <input type="text" wire:model.defer="title_deed_number"
                                                class="form-control premium-input shadow-none <?php if($errors->has('title_deed_number')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_title_deed_number'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title_deed_number'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.electricity_account_number'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" wire:model.defer="electricity_account_number"
                                                class="form-control premium-input shadow-none <?php if($errors->has('electricity_account_number')): ?> is-invalid-premium <?php endif; ?>"
                                                autocomplete="off" placeholder="<?php echo __('properties.enter_electricity_account'); ?>">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['electricity_account_number'];
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
                                    <div class="col-xl-3 col-lg-6 mb-2">
                                        <div class="premium-form-group">
                                            <label class="premium-label"><?php echo __('properties.water_account_number'); ?> <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                class="premium-input-wrapper <?php if($errors->has('water_account_number')): ?> is-invalid-premium <?php endif; ?>">
                                                <input type="text" wire:model.defer="water_account_number"
                                                    class="form-control premium-input shadow-none" autocomplete="off"
                                                    placeholder="<?php echo __('properties.enter_water_account'); ?>">

                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['water_account_number'];
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
                        </div>
                    </div>

                    <!-- Row 3: Owners & Ownership (Repeater) -->
                    <div class="card premium-card mb-2 <?php if($errors->has('property_owners') || $errors->has('property_owners_total') || $errors->has('property_owners_primary')): ?> premium-card-error-glow pulse-error <?php endif; ?>"
                        wire:key="owners-card-wrapper-<?php echo e($validation_fail_nonce); ?>">
                        <div
                            class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center position-relative">
                            <div class="font-weight-bold text-dark"><?php echo __('properties.owners_and_ownership'); ?></div>

                            <div class="total-percentage-header-badge d-flex align-items-center position-absolute"
                                style="left: 50%; transform: translateX(-50%); white-space: nowrap;">
                                <?php
                                    $total = collect($property_owners)->sum(function ($owner) {
                                        return is_numeric($owner['percentage']) ? (float) $owner['percentage'] : 0;
                                    });
                                    $badgeClass =
                                        $total == 100
                                            ? 'badge-light-success badge-glow-success'
                                            : ($total > 100
                                                ? 'badge-light-danger badge-glow-danger'
                                                : 'badge-light-primary badge-glow-primary');
                                ?>
                                <span class="mr-1 font-weight-bold text-muted small"><?php echo __('properties.total_percentage'); ?>:</span>
                                <span
                                    class="badge badge-pill <?php echo e($badgeClass); ?> font-14 py-1 px-2"><?php echo e($total); ?>%</span>
                            </div>

                            <div class="text-center">
                                <button type="button" wire:click="openOwnerModal" class="btn-premium-add-guarantor"
                                    title="<?php echo e(__('properties.add_owner')); ?>">
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
                                                <?php echo __('properties.owner_name_ar'); ?></th>
                                            <th class="align-middle py-3 border-top-0">
                                                <?php echo __('properties.owner_name_en'); ?></th>
                                            <th class="align-middle py-3 border-top-0">
                                                <?php echo __('properties.id_number_or_record'); ?></th>
                                            <th class="align-middle py-3 border-top-0">
                                                <?php echo __('properties.phone'); ?></th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                <?php echo __('properties.percentage'); ?></th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                <?php echo __('properties.is_primary'); ?></th>
                                            <th class="align-middle py-3 border-top-0 text-center">
                                                <i class="fas fa-trash-alt header-trash-icon"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $property_owners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="owner-row"
                                                wire:key="owner-row-<?php echo e($index); ?>-<?php echo e($validation_fail_nonce); ?>">
                                                <td class="align-middle">
                                                    <div class="user-info-cell">
                                                        <span class="user-name-text">
                                                            <?php echo e($owner['name_ar'] ?: '---'); ?>

                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted small">
                                                        <?php echo e($owner['name_en'] ?: '---'); ?>

                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted font-weight-bold">
                                                        <?php echo e($owner['identification_number'] ?? '---'); ?>

                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-dark font-weight-bold text-left ltr-text">
                                                        <?php echo e($owner['phone'] ?? '---'); ?>

                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="premium-form-group mb-0 mx-auto"
                                                        style="max-width: 100px;">
                                                        <div
                                                            class="premium-input-wrapper <?php if($errors->has("property_owners.$index.percentage")): ?> is-invalid-premium <?php endif; ?>">
                                                            <input type="number" step="0.01"
                                                                wire:model.live="property_owners.<?php echo e($index); ?>.percentage"
                                                                class="form-control premium-input shadow-none text-center compact-input"
                                                                autocomplete="off"
                                                                style="height: 32px !important; font-size: 0.9rem;"
                                                                placeholder="0.00 %">
                                                        </div>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["property_owners.$index.percentage"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger error-text d-block mt-1"
                                                                style="font-size: 0.7rem;"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div
                                                        class="custom-control custom-radio custom-radio-premium d-inline-block">
                                                        <input type="radio"
                                                            wire:click="setPrimary(<?php echo e($index); ?>)"
                                                            <?php if($owner['is_primary']): ?> checked <?php endif; ?>
                                                            id="primary_radio_<?php echo e($index); ?>"
                                                            name="primary_owner_radio" class="custom-control-input">
                                                        <label class="custom-control-label"
                                                            for="primary_radio_<?php echo e($index); ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <button type="button"
                                                        wire:click="removeOwner(<?php echo e($index); ?>)"
                                                        class="btn-premium-action btn-premium-action-danger remove-owner-btn shadow-none btn-trash-cell">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="7" class="text-center p-3 text-dark font-weight-bold">
                                                    <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                    <?php echo __('properties.no_owners_added'); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_owners'];
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_owners_total'];
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['property_owners_primary'];
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



                    <!-- Row for Attachments -->
                    <div class="card premium-card mb-2 premium-card-anim">
                        <div class="premium-mandatory-header py-2 border-bottom-0">
                            <div class="font-weight-bold text-dark"><?php echo __('properties.attachments'); ?></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1"><?php echo __('properties.rental_contract_original'); ?></span>
                                            <div class="file-action-buttons">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rental_contract_original): ?>
                                                    <button type="button"
                                                        wire:click="resetFile('rental_contract_original')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="<?php echo __('general.remove'); ?>">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper <?php if($errors->has('rental_contract_original')): ?> is-invalid-premium <?php endif; ?>">
                                            <input type="file" wire:model="rental_contract_original"
                                                class="d-none" id="rental_contract_original">
                                            <label for="rental_contract_original"
                                                class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-contract text-primary"></i></div>
                                                        <span class="file-name text-muted">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rental_contract_original): ?>
                                                                <?php echo e($rental_contract_original->getClientOriginalName()); ?>

                                                            <?php else: ?>
                                                                <?php echo __('general.choose_file'); ?>

                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-primary"><?php echo __('general.browse'); ?></span>
                                                </div>
                                            </label>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rental_contract_original'];
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
                                
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1"><?php echo __('properties.building_completion_certificate'); ?></span>
                                            <div class="file-action-buttons">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($building_completion_certificate): ?>
                                                    <button type="button"
                                                        wire:click="resetFile('building_completion_certificate')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="<?php echo __('general.remove'); ?>">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper <?php if($errors->has('building_completion_certificate')): ?> is-invalid-premium <?php endif; ?>">
                                            <input type="file" wire:model="building_completion_certificate"
                                                class="d-none" id="building_completion_certificate">
                                            <label for="building_completion_certificate"
                                                class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-pdf text-danger"></i></div>
                                                        <span class="file-name text-muted">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($building_completion_certificate): ?>
                                                                <?php echo e($building_completion_certificate->getClientOriginalName()); ?>

                                                            <?php else: ?>
                                                                <?php echo __('general.choose_file'); ?>

                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-danger"><?php echo __('general.browse'); ?></span>
                                                </div>
                                            </label>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['building_completion_certificate'];
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
                                
                                <div class="col-md-4 mb-2">
                                    <div class="premium-form-group">
                                        <div class="premium-label d-flex align-items-center">
                                            <span class="mr-1"><?php echo __('properties.other_documents'); ?></span>
                                            <div class="file-action-buttons">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($other_documents): ?>
                                                    <button type="button" wire:click="resetFile('other_documents')"
                                                        class="btn-file-action btn-delete-file"
                                                        title="<?php echo __('general.remove'); ?>">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                        <div
                                            class="premium-file-upload-wrapper <?php if($errors->has('other_documents')): ?> is-invalid-premium <?php endif; ?>">
                                            <input type="file" wire:model="other_documents" class="d-none"
                                                id="other_documents">
                                            <label for="other_documents" class="premium-file-label w-100 mb-0">
                                                <div
                                                    class="premium-file-box d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="file-icon-box"><i
                                                                class="fas fa-file-alt text-info"></i></div>
                                                        <span class="file-name text-muted">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($other_documents): ?>
                                                                <?php echo e($other_documents->getClientOriginalName()); ?>

                                                            <?php else: ?>
                                                                <?php echo __('general.choose_file'); ?>

                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="browse-badge browse-badge-info"><?php echo __('general.browse'); ?></span>
                                                </div>
                                            </label>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['other_documents'];
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
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('dashboard.properties.quick-owner-modal', ['parentCompanyId' => $company_id,'parent_company_id' => $company_id]);

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4056881880-0', null);

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
        function initSelect2() {
            // Destroy existing instances to prevent double arrows
            $('.select2').each(function() {
                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
            });

            // Standard Select2 (Property Type, Status, etc.)
            $('.select2:not(.ajax-select)').each(function() {
                $(this).select2({
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr',
                    dropdownParent: $(this).parent()
                }).on('change', function(e) {
                    let wireModel = $(this).attr('wire:model.defer');
                    if (wireModel) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set(wireModel, e.target.value);
                    }
                });
            });

            // Parent ID (AJAX Select2)
            const $parentSelect = $('#parent_id');
            if ($parentSelect.length && typeof initGenericSelect2 === "function") {
                const companyId = window.Livewire.find('<?php echo e($_instance->getId()); ?>').get('company_id');

                // First call standard init to get premium styling
                initGenericSelect2($parentSelect, "<?php echo route('dashboard.properties.autocomplete'); ?>", "<?php echo __('properties.standalone_property'); ?>");

                // Then override AJAX config to include company_id and force width
                const existingConfig = $parentSelect.data('select2').options.options;
                $parentSelect.select2($.extend(true, {}, existingConfig, {
                    width: '100%',
                    dropdownParent: $parentSelect.parent(),
                    ajax: {
                        data: function(params) {
                            return {
                                q: params.term,
                                page: params.page,
                                company_id: companyId
                            };
                        }
                    }
                }));

                $parentSelect.on('change', function(e) {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('parent_id', $(this).val());
                });
            }
        }

        document.addEventListener('livewire:initialized', () => {
            initSelect2();
            Livewire.on('rowAdded', () => {
                setTimeout(initSelect2, 150);
            });

            // Re-init Select2 on every morph update to catch validation refreshes
            Livewire.hook('morph.updated', (el, component) => {
                if ($(el).is('select.select2') || $(el).find('select.select2').length > 0) {
                    initSelect2();
                }
            });
        });

        $(function() {
            initSelect2();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\rental\resources\views/livewire/dashboard/properties/create-property.blade.php ENDPATH**/ ?>