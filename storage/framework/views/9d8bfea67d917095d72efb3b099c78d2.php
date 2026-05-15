<div class="badge badge-pill badge-glow user_status_<?php echo $user->id; ?> <?php echo $user->status == 1 ? 'badge-success' : 'badge-danger'; ?>"
    style="font-size: 12px; font-weight: bold; padding: 5px 12px;">
    <?php echo $user->status == 1 ? __('general.enable') : __('general.disabled'); ?>

</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/users/parts/status.blade.php ENDPATH**/ ?>