<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('departments_update')): ?>
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_<?php echo $department->id; ?>" data-id="<?php echo $department->id; ?>"
            <?php echo $department->status == 1 ? 'checked' : ''; ?>>
        <span class="modern-slider"></span>
    </label>
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/departments/parts/manage_status.blade.php ENDPATH**/ ?>