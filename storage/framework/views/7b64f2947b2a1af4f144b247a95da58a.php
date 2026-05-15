<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('owners_update')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="<?php echo __('general.edit'); ?>" 
                data-url="<?php echo route('dashboard.owners.update', $owner->id); ?>"
                data-id="<?php echo $owner->id; ?>" 
                data-name_ar="<?php echo $owner->getTranslation('name', 'ar'); ?>"
                data-name_en="<?php echo $owner->getTranslation('name', 'en'); ?>" 
                data-phone="<?php echo $owner->phone; ?>"
                data-identification_number="<?php echo $owner->identification_number; ?>"
                data-type="<?php echo $owner->type; ?>"
                data-status="<?php echo $owner->status; ?>"
                data-email="<?php echo $owner->email; ?>"
                data-address="<?php echo $owner->address; ?>" 
                data-notes="<?php echo $owner->notes; ?>" 
                data-company_id="<?php echo $owner->company_id; ?>" 
                data-company="<?php echo optional($owner->company)->name; ?>"
                data-toggle="modal" data-target="#editModal">
                <i class="fas fa-edit"></i>
            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('owners_delete')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="<?php echo $owner->id; ?>" data-route="<?php echo route('dashboard.owners.destroy'); ?>"
                data-title="<?php echo __('general.ask_delete_record'); ?>" data-text="<?php echo __('general.delete_warning_text'); ?>"
                data-confirm-btn="<?php echo __('general.yes'); ?>" data-cancel-btn="<?php echo __('general.no'); ?>"
                data-success-title="<?php echo __('general.deleted'); ?>"
                data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/owners/parts/actions.blade.php ENDPATH**/ ?>