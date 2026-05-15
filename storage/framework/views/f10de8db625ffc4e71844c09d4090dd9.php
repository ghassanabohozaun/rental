<div class="badge badge-pill badge-glow premium-status-badge property_type_status_<?php echo $property_type->id; ?> <?php echo $property_type->status == 1 ? 'badge-success' : 'badge-danger'; ?>">
    <?php echo $property_type->status == 1 ? __('general.enable') : __('general.disabled'); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/property_types/parts/status.blade.php ENDPATH**/ ?>