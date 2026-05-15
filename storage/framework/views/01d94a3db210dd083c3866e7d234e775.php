<div class="d-flex align-items-center justify-content-center">
    
    <a href="<?php echo route('dashboard.properties.show', $property->id); ?>" 
       class="btn-premium-action btn-premium-action-info mr-1" 
       title="<?php echo __('general.show'); ?>">
        <i class="fas fa-eye"></i>
    </a>

    
    <a href="<?php echo route('dashboard.properties.edit', $property->id); ?>" 
       class="btn-premium-action btn-premium-action-edit mr-1" 
       title="<?php echo __('general.edit'); ?>">
        <i class="fas fa-edit"></i>
    </a>

    
    <a href="javascript:void(0)" 
       class="btn-premium-action btn-premium-action-danger delete-confirm" 
       data-id="<?php echo $property->id; ?>" 
       data-route="<?php echo route('dashboard.properties.destroy'); ?>"
       data-title="<?php echo __('general.ask_delete_record'); ?>" 
       data-text="<?php echo __('general.delete_warning_text'); ?>"
       data-confirm-btn="<?php echo __('general.yes'); ?>" 
       data-cancel-btn="<?php echo __('general.no'); ?>"
       data-success-title="<?php echo __('general.deleted'); ?>" 
       data-success-text="<?php echo __('general.delete_success_message'); ?>"
       title="<?php echo __('general.delete'); ?>">
        <i class="fas fa-trash-alt"></i>
    </a>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/properties/parts/actions.blade.php ENDPATH**/ ?>