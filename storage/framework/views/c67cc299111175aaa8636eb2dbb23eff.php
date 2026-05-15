<?php
    $size = $size ?? 40;
    $photoUrl = $user->userPhoto();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photoUrl): ?>
    <img src="<?php echo $photoUrl; ?>" class="avatar-circle avatar-size-<?php echo $size; ?>" alt="User">
<?php else: ?>
    <div class="avatar-circle avatar-size-<?php echo $size; ?> d-flex align-items-center justify-content-center text-white"
         style="background-color: <?php echo $user->getAvatarColor(); ?>;">
        <i class="fas fa-user avatar-icon-<?php echo $size; ?>"></i>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/users/parts/photo.blade.php ENDPATH**/ ?>