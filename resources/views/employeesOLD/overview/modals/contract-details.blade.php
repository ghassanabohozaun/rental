<div class="modal modal-pop fade" id="contractDetailsModal" tabindex="-1" aria-labelledby="contractDetailsModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header px-4 py-3">
                <h5 class="modal-title" id="contractDetailsModalLabel">
                    <i class="mdi mdi-file-document-outline text-primary fs-4"></i>
                    {!! __('employees.contract_details') !!}
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="premium-card p-3 rounded-4 bg-light border mb-3">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">{!! __('employees.contract_duration') !!}</label>
                            <p class="fw-bold mb-0" id="det_duration">---</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">{!! __('employees.monthly_salary') !!}</label>
                            <p class="fw-bold mb-0 text-primary" id="det_salary">---</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">{!! __('employees.contract_start_date') !!}</label>
                            <p class="fw-bold mb-0" id="det_start_date">---</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">{!! __('employees.contract_expire_date') !!}</label>
                            <p class="fw-bold mb-0 text-danger" id="det_expiry_date">---</p>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-2 p-3 rounded-3 bg-label-success border border-success-light">
                    <i class="mdi mdi-check-circle-outline fs-4 text-success"></i>
                    <div>
                        <span class="d-block small fw-bold text-success text-uppercase" style="letter-spacing: 0.5px;">{!! __('employees.status') !!}</span>
                        <span class="fw-bold" id="det_status">---</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 py-3">
                <button type="button" class="btn btn-light px-4 py-2" data-bs-dismiss="modal">
                    {{ __('general.close') }}
                </button>
            </div>
        </div>
    </div>
</div>
