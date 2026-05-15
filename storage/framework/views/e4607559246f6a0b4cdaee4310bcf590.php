<?php
    $size = $size ?? 45;
    $logoUrl = $company->logo_url;
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logoUrl): ?>
    <div class="premium-avatar-wrapper mx-auto"
        style="width: <?php echo $size; ?>px; height: <?php echo $size; ?>px;">
        <img src="<?php echo $logoUrl; ?>" alt="<?php echo $company->name; ?>" class="premium-avatar shadow-sm"
            style="width:100%; height:100%; border-radius: 8px; object-fit: cover;">
    </div>
<?php else: ?>
    <div class="avatar-circle avatar-size-<?php echo $size; ?> d-inline-flex align-items-center justify-content-center text-white shadow-sm"
        style="background-color: <?php echo $company->getAvatarColor(); ?>; width: <?php echo $size; ?>px; height: <?php echo $size; ?>px; border-radius: 8px; font-weight: bold; font-size: <?php echo $size / 2.5; ?>px;">
        <?php echo $company->initials; ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/companies/parts/logo.blade.php ENDPATH**/ ?>