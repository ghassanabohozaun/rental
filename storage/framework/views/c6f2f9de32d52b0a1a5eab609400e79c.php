<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        
        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit edit_user_button"
            title="<?php echo __('general.edit'); ?>" user-id="<?php echo $user->id; ?>" user-name-ar="<?php echo $user->getTranslation('name', 'ar'); ?>"
            user-name-en="<?php echo $user->getTranslation('name', 'en'); ?>" user-email="<?php echo $user->email; ?>"
            user-mobile="<?php echo $user->mobile; ?>"
            user-role-id="<?php echo $user->role_id; ?>" user-status="<?php echo $user->status; ?>"
            user-company-id="<?php echo $user->company_id; ?>" user-company-name="<?php echo optional($user->company)->name; ?>"
            user-photo="<?php echo $user->photo; ?>" user-photo-url="<?php echo $user->userPhoto(); ?>"
            data-toggle="modal" data-target="#updateUserModal">
            <i class="fas fa-edit"></i>
        </a>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->id() != $user->id): ?>
            <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger delete-confirm"
                data-id="<?php echo $user->id; ?>" data-route="<?php echo route('dashboard.users.destroy'); ?>"
                data-title="<?php echo __('general.ask_delete_record'); ?>" data-text="<?php echo __('general.delete_warning_text'); ?>"
                data-confirm-btn="<?php echo __('general.yes'); ?>" data-cancel-btn="<?php echo __('general.no'); ?>"
                data-success-title="<?php echo __('general.deleted'); ?>"
                data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
        <?php else: ?>
            <button type="button" class="btn-premium-action btn-premium-action-danger disabled"
                style="opacity: 0.5; cursor: not-allowed;" title="<?php echo __('general.prevent_delete'); ?>">
                <i class="fas fa-trash-alt"></i>
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/users/parts/actions.blade.php ENDPATH**/ ?>