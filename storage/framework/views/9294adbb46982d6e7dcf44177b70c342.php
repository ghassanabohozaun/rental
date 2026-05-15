<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('maintenances_update')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="<?php echo __('general.edit'); ?>" 
                data-url="<?php echo route('dashboard.maintenances.update', $maintenance->id); ?>"
                data-id="<?php echo $maintenance->id; ?>" 
                data-description_ar="<?php echo $maintenance->getTranslation('description', 'ar'); ?>"
                data-description_en="<?php echo $maintenance->getTranslation('description', 'en'); ?>" 
                data-property_id="<?php echo $maintenance->property_id; ?>"
                data-property_name="<?php echo optional($maintenance->property)->name; ?>"
                data-date="<?php echo $maintenance->date; ?>" 
                data-cost="<?php echo $maintenance->cost; ?>"
                data-status="<?php echo $maintenance->status; ?>" 
                data-company_id="<?php echo $maintenance->company_id; ?>" 
                data-company="<?php echo optional($maintenance->company)->name; ?>"
                data-toggle="modal" data-target="#editModal">
                <i class="fas fa-edit"></i>
            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('maintenances_delete')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="<?php echo $maintenance->id; ?>" data-route="<?php echo route('dashboard.maintenances.destroy'); ?>"
                data-title="<?php echo __('general.ask_delete_record'); ?>" data-text="<?php echo __('general.delete_warning_text'); ?>"
                data-confirm-btn="<?php echo __('general.yes'); ?>" data-cancel-btn="<?php echo __('general.no'); ?>"
                data-success-title="<?php echo __('general.deleted'); ?>"
                data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/maintenances/parts/actions.blade.php ENDPATH**/ ?>