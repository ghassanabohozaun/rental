<div class="d-flex align-items-center justify-content-center">
    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $role)): ?>
        <a href="<?php echo route('dashboard.roles.edit', $role->id); ?>" 
           class="btn-premium-action btn-premium-action-edit mr-1" 
           title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>
    <?php else: ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($role->isSystemRole()): ?>
            <span class="btn-premium-action btn-premium-action-warning mr-1" 
                  style="cursor: help;"
                  title="<?php echo __('roles.system_role_protected'); ?>">
                <i class="fas fa-lock"></i>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $role)): ?>
        <a href="javascript:void(0)" 
           class="btn-premium-action btn-premium-action-danger delete-confirm" 
           data-id="<?php echo $role->id; ?>" 
           data-route="<?php echo route('dashboard.roles.destroy'); ?>"
           data-title="<?php echo __('general.ask_delete_record'); ?>" 
           data-text="<?php echo __('general.delete_warning_text'); ?>"
           data-confirm-btn="<?php echo __('general.yes'); ?>" 
           data-cancel-btn="<?php echo __('general.no'); ?>"
           data-success-title="<?php echo __('general.deleted'); ?>" 
           data-success-text="<?php echo __('general.delete_success_message'); ?>"
           title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>
    <?php endif; ?>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/roles/parts/actions.blade.php ENDPATH**/ ?>