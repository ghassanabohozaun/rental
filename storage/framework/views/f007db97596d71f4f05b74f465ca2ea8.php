<div class="badge badge-pill badge-glow premium-status-badge company_status_<?php echo $company->id; ?> <?php echo $company->status == 'active' ? 'badge-success' : 'badge-danger'; ?>">
    <?php echo $company->status == 'active' ? __('general.enable') : __('general.disabled'); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/parts/status.blade.php ENDPATH**/ ?>