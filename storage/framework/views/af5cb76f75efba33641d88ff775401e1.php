<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->

        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1 edit_property_type_button"
            property_type-id="<?php echo $property_type->id; ?>" property_type-name-ar="<?php echo $property_type->getTranslation('name', 'ar'); ?>"
            property_type-name-en="<?php echo $property_type->getTranslation('name', 'en'); ?>" 
            property_type-company-id="<?php echo $property_type->company_id; ?>"
            property_type-company-name="<?php echo optional($property_type->company)->name; ?>"
            title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>


        <!-- Delete -->

        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="<?php echo $property_type->id; ?>" data-route="<?php echo route('dashboard.property_types.destroy'); ?>" data-title="<?php echo __('general.ask_delete_record'); ?>"
            data-text="<?php echo __('general.delete_warning_text'); ?>" data-confirm-btn="<?php echo __('general.yes'); ?>"
            data-cancel-btn="<?php echo __('general.no'); ?>" data-success-title="<?php echo __('general.deleted'); ?>"
            data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_types/parts/actions.blade.php ENDPATH**/ ?>