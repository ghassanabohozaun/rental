<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->

        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1 edit_property_status_button"
            property_status-id="<?php echo $property_status->id; ?>" property_status-name-ar="<?php echo $property_status->getTranslation('name', 'ar'); ?>"
            property_status-name-en="<?php echo $property_status->getTranslation('name', 'en'); ?>" 
            property_status-color="<?php echo $property_status->color; ?>"
            property_status-company-id="<?php echo $property_status->company_id; ?>"
            property_status-company-name="<?php echo optional($property_status->company)->name; ?>"
            title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>


        <!-- Delete -->

        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="<?php echo $property_status->id; ?>" data-route="<?php echo route('dashboard.property_statuses.destroy'); ?>" data-title="<?php echo __('general.ask_delete_record'); ?>"
            data-text="<?php echo __('general.delete_warning_text'); ?>" data-confirm-btn="<?php echo __('general.yes'); ?>"
            data-cancel-btn="<?php echo __('general.no'); ?>" data-success-title="<?php echo __('general.deleted'); ?>"
            data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_statuses/parts/actions.blade.php ENDPATH**/ ?>