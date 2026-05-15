<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">
        <!-- Edit -->
        <a href="javascript:void(0)" 
            data-id="<?php echo $account->id; ?>" 
            data-bank_name_ar="<?php echo $account->getTranslation('bank_name', 'ar'); ?>"
            data-bank_name_en="<?php echo $account->getTranslation('bank_name', 'en'); ?>"
            data-account_number="<?php echo $account->account_number; ?>"
            data-account_holder_name_ar="<?php echo $account->getTranslation('account_holder_name', 'ar'); ?>"
            data-account_holder_name_en="<?php echo $account->getTranslation('account_holder_name', 'en'); ?>"
            data-iban="<?php echo $account->iban; ?>"
            data-is_default="<?php echo $account->is_default; ?>"
            data-company_id="<?php echo $account->company_id; ?>"
            data-company_name="<?php echo $account->company->name ?? ''; ?>"
            class="btn-premium-action btn-premium-action-edit mr-1 editBankAccountBtn"
            title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Delete -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bank_accounts_delete')): ?>
        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="<?php echo $account->id; ?>" data-route="<?php echo route('dashboard.bank-accounts.destroy', $account->id); ?>" 
            data-title="<?php echo __('general.ask_delete_record'); ?>"
            data-text="<?php echo __('general.delete_warning_text'); ?>" data-confirm-btn="<?php echo __('general.yes'); ?>"
            data-cancel-btn="<?php echo __('general.no'); ?>" data-success-title="<?php echo __('general.deleted'); ?>"
            data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/bank_accounts/parts/actions.blade.php ENDPATH**/ ?>