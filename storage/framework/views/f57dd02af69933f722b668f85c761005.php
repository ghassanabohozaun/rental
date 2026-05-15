<div class="d-flex justify-content-center align-items-center mb-0">
    <div class="btn-group" role="group">

        <!-- Edit -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companies_update')): ?>
        <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-edit mr-1"
            onclick="openEditCompanyModal({
                id: '<?php echo $company->id; ?>',
                name_ar: '<?php echo $company->getTranslation('name', 'ar'); ?>',
                name_en: '<?php echo $company->getTranslation('name', 'en'); ?>',
                email: '<?php echo $company->email; ?>',
                phone: '<?php echo $company->phone; ?>',
                address: '<?php echo $company->address; ?>',
                subscription_plan: '<?php echo $company->subscription_plan; ?>',
                status: '<?php echo $company->status; ?>',
                logo_url: '<?php echo $company->logo_url; ?>'
            })"
            title="<?php echo __('general.edit'); ?>">
            <i class="fas fa-edit"></i>
        </a>
        <?php endif; ?>

        <!-- Delete -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companies_delete')): ?>
        <a href="javascript:void(0)"
            class="btn-premium-action btn-premium-action-danger delete-confirm text-decoration-none"
            data-id="<?php echo $company->id; ?>" data-route="<?php echo route('dashboard.companies.destroy', $company->id); ?>" 
            data-title="<?php echo __('general.ask_delete_record'); ?>"
            data-text="<?php echo __('general.delete_warning_text'); ?>" data-confirm-btn="<?php echo __('general.yes'); ?>"
            data-cancel-btn="<?php echo __('general.no'); ?>" data-success-title="<?php echo __('general.deleted'); ?>"
            data-success-text="<?php echo __('general.delete_success_message'); ?>" title="<?php echo __('general.delete'); ?>">
            <i class="fas fa-trash-alt"></i>
        </a>
        <?php endif; ?>

    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/parts/actions.blade.php ENDPATH**/ ?>