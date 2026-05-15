<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companies_update')): ?>
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_<?php echo $company->id; ?>" data-id="<?php echo $company->id; ?>"
            <?php echo $company->status == 'active' ? 'checked' : ''; ?>>
        <span class="modern-slider"></span>
    </label>
</div>
<?php endif; ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/parts/manage_status.blade.php ENDPATH**/ ?>