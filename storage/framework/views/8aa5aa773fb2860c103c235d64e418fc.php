<!-- Details Modal for Guarantors -->
<div class="modal modal-pop" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content premium-modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold text-dark" id="detailsModalLabel">
                    <i class="fas fa-info mr-1"></i> <?php echo __('general.details'); ?>

                </h5>
                <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body my-2" id="modalBody">
                <!-- Content loaded from row-details via AJAX JS -->
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center premium-modal-footer">
                <button type="button" class="btn btn-premium-secondary" data-dismiss="modal">
                    <i class="fas fa-times-circle mr-2"></i> <?php echo __('general.close'); ?>

                </button>
            </div>
        </div>
    </div>
</div>


<?php /**PATH C:\laragon\www\rental\resources\views/dashboard/guarantors/modals/details.blade.php ENDPATH**/ ?>