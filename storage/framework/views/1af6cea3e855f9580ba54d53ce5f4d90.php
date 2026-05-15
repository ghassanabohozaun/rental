<!-- Details Modal for Maintenances -->
<div class="modal modal-pop" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content premium-modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="detailsModalLabel">
                    <i class="fas fa-info-circle text-primary mr-2 icon-size-18"></i> <?php echo __('general.details'); ?>

                </h6>
                <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body my-2" id="modalBody">
                <!-- Content loaded from row-details via AJAX JS -->
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10" data-dismiss="modal">
                    <i class="fas fa-times-circle mr-1"></i> <?php echo __('general.close'); ?>

                </button>
            </div>
        </div>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/maintenances/modals/details.blade.php ENDPATH**/ ?>