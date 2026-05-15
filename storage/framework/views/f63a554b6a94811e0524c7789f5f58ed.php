<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('property_statuses_update')): ?>
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_<?php echo $property_status->id; ?>" data-id="<?php echo $property_status->id; ?>"
            <?php echo $property_status->status == 1 ? 'checked' : ''; ?>>
        <span class="modern-slider"></span>
    </label>
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_statuses/parts/manage_status.blade.php ENDPATH**/ ?>