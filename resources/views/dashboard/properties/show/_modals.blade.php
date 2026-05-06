<!-- Payments Modal -->
<div class="modal modal-pop fade" id="paymentsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header bg-success text-white py-2 px-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h5 class="modal-title text-white mb-0">
                        <i class="fas fa-money-bill-wave mr-1"></i> {!! __('payments.payments') !!}
                    </h5>
                    <div class="d-flex align-items-center">
                        @can('payments_create')
                        <a href="#" id="modalAddPaymentBtn" class="btn btn-sm btn-white text-success px-3 radius-8 font-weight-bolder shadow-sm mr-2" style="background: white !important;">
                            <i class="fas fa-plus-circle mr-1"></i> {!! __('payments.add_payment') !!}
                        </a>
                        @endcan
                        <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body p-0" id="paymentsModalBody">
                <div class="p-3 text-center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cheques Modal -->
<div class="modal modal-pop fade" id="chequesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header bg-warning text-white py-2 px-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h5 class="modal-title text-white mb-0">
                        <i class="fas fa-money-check-alt mr-1"></i> {!! __('cheques.cheques') !!}
                    </h5>
                    <div class="d-flex align-items-center">
                        @can('cheques_create')
                        <a href="#" id="modalAddChequeBtn" class="btn btn-sm btn-white text-warning px-3 radius-8 font-weight-bolder shadow-sm mr-2" style="background: white !important;">
                            <i class="fas fa-plus-circle mr-1"></i> {!! __('cheques.add_cheque') !!}
                        </a>
                        @endcan
                        <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body p-0" id="chequesModalBody">
                <div class="p-3 text-center">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
