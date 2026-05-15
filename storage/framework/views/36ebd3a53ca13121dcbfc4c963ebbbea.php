<div class="badge badge-pill badge-glow premium-status-badge department_status_<?php echo $department->id; ?> <?php echo $department->status == 1 ? 'badge-success' : 'badge-danger'; ?>">
    <?php echo $department->status == 1 ? __('general.enable') : __('general.disabled'); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/departments/parts/status.blade.php ENDPATH**/ ?>