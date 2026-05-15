<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> <?php echo __('general.filters'); ?>:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data" data-loader=".table-loader-overlay">
            
            <!-- 1. Property Search (Keyword) -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="property_search_popover">
                    <i class="fas fa-search text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.property'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="property_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('properties.property'); ?></label>
                        <div class="premium-input-wrapper">
                            <input type="text" class="form-control premium-input shadow-none" name="keyword"
                                placeholder="<?php echo __('general.search'); ?>..." autocomplete="off">
                            <i class="fas fa-search text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Company Filter (If exists) -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies) && $companies->count() > 0): ?>
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text"><?php echo __('companies.company'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="company_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('companies.company'); ?></label>
                        <div class="premium-input-wrapper">
                            <select name="company_id" id="filter_company_id" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="<?php echo __('general.all_companies'); ?>"
                                data-parent="#company_search_popover">
                                <option value=""><?php echo __('general.all_companies'); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                            <i class="fas fa-briefcase text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- 3. Dependency Filter (Main/Sub) -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="dependency_search_popover">
                    <i class="fas fa-sitemap text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.parent_property'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="dependency_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('properties.parent_property'); ?></label>
                        <div class="premium-input-wrapper">
                            <select name="dependency_status" id="filter_dependency" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="<?php echo __('general.all'); ?>"
                                data-parent="#dependency_search_popover">
                                <option value=""><?php echo __('general.all'); ?></option>
                                <option value="main"><?php echo __('properties.standalone_property'); ?></option>
                                <option value="sub"><?php echo __('properties.sub_property'); ?></option>
                            </select>
                            <i class="fas fa-sitemap text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. Status Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="status_search_popover">
                    <i class="fas fa-check-circle text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.status'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="status_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('properties.status'); ?></label>
                        <div class="premium-input-wrapper">
                            <select name="property_status_id" id="filter_status" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="<?php echo __('general.all'); ?>"
                                data-parent="#status_search_popover">
                                <option value=""><?php echo __('general.all'); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                            <i class="fas fa-check-circle text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- 5. Type Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="type_search_popover">
                    <i class="fas fa-tags text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.property_type'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="type_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('properties.property_type'); ?></label>
                        <div class="premium-input-wrapper">
                            <select name="property_type_id" id="filter_type" 
                                class="form-control premium-input shadow-none js-select2"
                                data-placeholder="<?php echo __('general.all'); ?>"
                                data-parent="#type_search_popover">
                                <option value=""><?php echo __('general.all'); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $property_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                            <i class="fas fa-tags text-primary"></i>
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- 6. Price Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="price_search_popover">
                    <i class="fas fa-money-bill-wave text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.price'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="price_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-1 small text-muted"><?php echo __('general.min'); ?></label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="price_min"
                                placeholder="0" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="premium-label mb-1 small text-muted"><?php echo __('general.max'); ?></label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="price_max"
                                placeholder="..." autocomplete="off">
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- 7. Area Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="area_search_popover">
                    <i class="fas fa-ruler-combined text-primary"></i>
                    <span class="chip-text"><?php echo __('properties.area'); ?></span>
                </div>

                <div class="ptc-query-panel shadow-lg border-0" id="area_search_popover" style="min-width: 280px;">
                    <div class="mb-3">
                        <label class="premium-label mb-1 small text-muted"><?php echo __('general.min'); ?></label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="area_min"
                                placeholder="0" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="premium-label mb-1 small text-muted"><?php echo __('general.max'); ?></label>
                        <div class="premium-input-wrapper">
                            <input type="number" class="form-control premium-input shadow-none" name="area_max"
                                placeholder="..." autocomplete="off">
                        </div>
                    </div>
                    <div class="popover-actions mt-4 text-right">
                        <button type="button" class="btn btn-premium-blue btn-sm js-apply-filter px-4">
                            <i class="fas fa-check-circle mr-1"></i> <?php echo __('general.apply'); ?>

                        </button>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="filter-chip reset-chip js-reset-btn">
                <i class="fas fa-sync"></i>
                <span><?php echo __('general.reset'); ?></span>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo asset('assets/dashbaord/js/filter-system.js'); ?>"></script>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/properties/partials/_search.blade.php ENDPATH**/ ?>