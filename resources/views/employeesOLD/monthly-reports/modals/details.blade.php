<div class="modal fade" id="detailsMonthlyReportModal" tabindex="-1" aria-labelledby="detailsMonthlyReportModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body p-0">
                <div class="modal-details-card">
                    <!-- Header Gradient -->
                    <div class="premium-modal-header">
                        <button type="button" class="btn-close btn-close-white p-3" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 10px; z-index: 10;"></button>
                    </div>

                    <div class="text-center">
                        <div class="modal-profile-wrapper">
                            <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm" style="background-color: #1F3BB3;">
                                <i class="fa fa-file-text-o" style="font-size: 40px;"></i>
                            </div>
                        </div>
                        <h4 class="modal-name-title font-weight-bold" id="display_employee_name">---</h4>
                        <span class="modal-role-badge">{!! __('monthlyReports.monthly_reports') !!}</span>
                    </div>

                    <!-- Detail Items List -->
                    <div class="modal-info-list mt-2">
                        <div class="detail-item-modern">
                            <div class="icon-circle"><i class="fa fa-calendar"></i></div>
                            <div class="detail-info-box text-left">
                                <span class="detail-info-label">{!! __('monthlyReports.month') !!} / {!! __('monthlyReports.year') !!}</span>
                                <span class="detail-info-value font-weight-bold " id="display_month_year">---</span>
                            </div>
                        </div>

                        <div class="detail-item-modern">
                            <div class="icon-circle"><i class="fa fa-info-circle"></i></div>
                            <div class="detail-info-box text-left">
                                <span class="detail-info-label">{!! __('monthlyReports.status') !!}</span>
                                <div id="display_status" class="mt-1">---</div>
                            </div>
                        </div>

                        <div class="detail-item-modern">
                            <div class="icon-circle"><i class="fa fa-align-left"></i></div>
                            <div class="detail-info-box text-left w-100">
                                <span class="detail-info-label">{!! __('monthlyReports.details') !!}</span>
                                <div class="detail-info-value mt-1 p-2 bg-light border rounded" id="display_details" style="max-height: 200px; overflow-y: auto; white-space: pre-wrap;">
                                    ---
                                </div>
                            </div>
                        </div>

                        <div id="refusal_section" class="detail-item-modern d-none border-danger border-opacity-25">
                            <div class="icon-circle text-danger"><i class="fa fa-times-circle"></i></div>
                            <div class="detail-info-box text-left w-100">
                                <span class="detail-info-label text-danger">{!! __('monthlyReports.refuse_reason') !!}</span>
                                <div class="detail-info-value mt-1 p-2 bg-soft-danger border border-danger border-opacity-10 rounded text-danger" id="display_refuse_reason" style="white-space: pre-wrap;">
                                    ---
                                </div>
                            </div>
                        </div>

                        <div class="detail-item-modern">
                            <div class="icon-circle"><i class="fa fa-file-o"></i></div>
                            <div class="detail-info-box text-left">
                                <span class="detail-info-label">{!! __('monthlyReports.file') !!}</span>
                                <div id="display_file_area" class="mt-1">
                                    <!-- This will be populated if needed, or we can just show a link if we pass it -->
                                    <span class="text-muted small">---</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center pb-4">
                <button type="button" class="btn btn-secondary px-5 py-2 fw-bold" style="border-radius: 10px;" data-bs-dismiss="modal">{!! __('general.close') !!}</button>
            </div>
        </div>
    </div>
</div>


