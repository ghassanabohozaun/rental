<input type="hidden" id="properties-total-count" value="<?php echo $properties->total(); ?>">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead>
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- Mobile Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0" style="width: 50px;">#</th>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                    <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell"><?php echo __('companies.company'); ?></th>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <th class="align-middle py-3 border-top-0 property-info-td"><?php echo __('properties.property'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell"><?php echo __('properties.type'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell"><?php echo __('properties.parent_property'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell"><?php echo __('properties.area'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell"><?php echo __('properties.price'); ?></th>
                <th class="text-center align-middle py-3 border-top-0"><?php echo __('properties.status'); ?></th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140"><?php echo __('general.actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="row<?php echo e($property->id); ?>">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 22px;"></i>
                        </span>
                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-building font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold"><?php echo $property->name; ?></h4>
                                    <span class="modal-role-badge"><?php echo optional($property->propertyType)->name; ?></span>
                                </div>
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label"><?php echo __('properties.location'); ?></span>
                                            <span class="detail-info-value text-muted small"><?php echo $property->location ?? '---'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- ID -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            <?php echo $loop->iteration + ($properties->currentPage() - 1) * $properties->perPage(); ?>

                        </span>
                    </td>

                    <!-- Company -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($companies)): ?>
                        <td class="text-center align-middle d-none d-md-table-cell">
                            <a href="javascript:void(0)" class="company-chip">
                                <i class="fas fa-briefcase mr-1"></i>
                                <?php echo optional($property->company)->name; ?>

                            </a>
                        </td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- Property Info (Name + Location) -->
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text"><?php echo $property->name; ?></span>
                            <span class="user-email-text"><i class="fas fa-map-marker-alt mr-25"></i> <?php echo Str::limit($property->location, 30) ?? '---'; ?></span>
                        </div>
                    </td>

                    <!-- Type -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="property-type-badge">
                            <?php echo optional($property->propertyType)->name; ?>

                        </span>
                    </td>

                    <!-- Parent Property -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->parent_id): ?>
                            <span class="badge badge-light-warning badge-pill">
                                <i class="fas fa-link mr-1 font-11"></i>
                                <?php echo optional($property->parent)->name; ?>

                            </span>
                        <?php else: ?>
                            <span class="badge badge-light-primary badge-pill">
                                <i class="fas fa-sitemap mr-1 font-11"></i>
                                <?php echo __('properties.standalone_property'); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>

                    <!-- Area -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <span class="area-badge">
                            <?php echo $property->area ?? '---'; ?>

                        </span>
                    </td>

                    <!-- Price -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="flex-column-center">
                            <span class="font-weight-bold text-dark font-14">
                                <?php echo $property->price ? number_format($property->price, 0) : '---'; ?>

                            </span>
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->propertyStatus): ?>
                            <span class="premium-badge" style="background-color: <?php echo $property->propertyStatus->color; ?>15; color: <?php echo $property->propertyStatus->color; ?>;">
                                <i class="fas fa-circle font-11 mr-1"></i>
                                <?php echo $property->propertyStatus->name; ?>

                            </span>
                        <?php else: ?>
                            <span class="text-muted">---</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center gap-2">
                            <?php echo $__env->make('dashboard.properties.parts.actions', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center p-4">
                        <div class="flex-column-center">
                            <i class="fas fa-info-circle text-muted font-40 mb-2"></i>
                            <h5 class="text-muted"><?php echo __('properties.no_properties_found'); ?></h5>
                        </div>
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
    
    <!-- Modern Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3 px-2">
        <div class="text-muted font-12">
            <?php echo __('general.showing'); ?> <?php echo e($properties->firstItem()); ?> <?php echo __('general.to'); ?> <?php echo e($properties->lastItem()); ?> <?php echo __('general.of'); ?> <?php echo e($properties->total()); ?> <?php echo __('properties.properties'); ?>

        </div>
        <div class="custom-pagination">
            <?php echo $properties->links(); ?>

        </div>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/properties/partials/_table.blade.php ENDPATH**/ ?>