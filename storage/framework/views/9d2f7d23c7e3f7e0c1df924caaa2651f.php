<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('guarantors_update')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit js-edit-btn"
                title="<?php echo __('general.edit'); ?>" 
                data-url="<?php echo route('dashboard.guarantors.update', $guarantor->id); ?>"
                data-id="<?php echo $guarantor->id; ?>" 
                data-name_ar="<?php echo $guarantor->getTranslation('name', 'ar'); ?>"
                data-name_en="<?php echo $guarantor->getTranslation('name', 'en'); ?>" 
                data-phone="<?php echo $guarantor->phone; ?>"
                data-id_number="<?php echo $guarantor->id_number; ?>"
                data-address="<?php echo $guarantor->address; ?>" 
                data-relationship="<?php echo $guarantor->relationship; ?>"
                data-notes="<?php echo $guarantor->notes; ?>" 
                data-company_id="<?php echo $guarantor->company_id; ?>" 
                data-company="<?php echo optional($guarantor->company)->name; ?>"
                data-toggle="modal" data-target="#editModal">
                <i class="fas fa-edit"></i>
            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('guarantors_delete')): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="<?php echo $guarantor->id; ?>" data-route="<?php echo route('dashboard.guarantors.destroy'); ?>"
                data-title="<?php echo __('general.ask_delete_record'); ?>" data-text="<?php echo __('general.delete_warning_text'); ?>"
                data-confirm-btn="<?php echo __('general.yes'); ?>" data-cancel-btn="<?php echo __('general.no'); ?>"
                data-success-title="<?php echo __('general.deleted'); ?>"
                data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/guarantors/parts/actions.blade.php ENDPATH**/ ?>