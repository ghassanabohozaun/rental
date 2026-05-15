<div class="query-bar-container">
    <div class="query-bar js-query-bar">
        <span class="query-bar-label">
            <i class="fas fa-filter"></i> <?php echo __('general.filters'); ?>:
        </span>

        <form class="js-filter-form d-flex align-items-center gap-2" data-container="#table_data"
            data-loader=".table-loader-overlay">

            <!-- Owner Search -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="owner_search_popover">
                    <i class="fas fa-user-friends text-primary"></i>
                    <span class="chip-text"><?php echo __('owners.owners'); ?></span>
                </div>

                <!-- Owner Search Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="owner_search_popover">
                    <div class="mb-3">
                        <label class="premium-label mb-2"><?php echo __('owners.owners'); ?></label>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies) && $companies->count() > 0): ?>
            <!-- Company Filter -->
            <div class="filter-item">
                <div class="filter-chip js-filter-chip" data-filter-target="company_search_popover">
                    <i class="fas fa-briefcase text-primary"></i>
                    <span class="chip-text"><?php echo __('companies.company'); ?></span>
                </div>

                <!-- Company Filter Popover -->
                <div class="ptc-query-panel shadow-lg border-0 radius-16" id="company_search_popover" style="min-width: 280px;">
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


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/owners/partials/_search.blade.php ENDPATH**/ ?>