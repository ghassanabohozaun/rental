<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->

        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1 edit_department_button"
            department-id="<?php echo $department->id; ?>" department-name-ar="<?php echo $department->getTranslation('name', 'ar'); ?>"
            department-name-en="<?php echo $department->getTranslation('name', 'en'); ?>" 
            department-company-id="<?php echo $department->company_id; ?>"
            department-company-name="<?php echo optional($department->company)->name; ?>"
            title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>


        <!-- Delete -->

        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="<?php echo $department->id; ?>" data-route="<?php echo route('dashboard.departments.destroy'); ?>" data-title="<?php echo __('general.ask_delete_record'); ?>"
            data-text="<?php echo __('general.delete_warning_text'); ?>" data-confirm-btn="<?php echo __('general.yes'); ?>"
            data-cancel-btn="<?php echo __('general.no'); ?>" data-success-title="<?php echo __('general.deleted'); ?>"
            data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/departments/parts/actions.blade.php ENDPATH**/ ?>