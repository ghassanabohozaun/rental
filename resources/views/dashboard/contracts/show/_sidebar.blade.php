<!-- Compact Sidebar Stats Panel for Contracts -->
<div class="sidebar-stats-panel">
    <div class="card premium-card border-0 shadow-sm overflow-hidden radius-15 bg-white">
        <!-- Header - Premium Wallet Icon -->
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-wallet text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('contracts.financial_summary') !!}
            </h5>
        </div>

        <div class="card-body p-2 d-flex flex-column h-100" style="padding-bottom: 28px !important;">
            <!-- 1. Financial Summary Section (Side-by-Side) - Dashed Border -->
            <div class="stat-section mb-2 p-2 rounded border-dashed-premium">
                <div class="row no-gutters align-items-center">
                    <!-- Paid Amount -->
                    <div class="col-6 text-center border-right-light">
                        <span class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('payments.paid_amount') !!}</span>
                        <span class="font-weight-bold font-large-2 text-success">{!! number_format($contract->paid_amount, 0) !!}</span>
                    </div>

                    <!-- Remaining Amount -->
                    <div class="col-6 text-center">
                        <span class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('payments.remaining_amount') !!}</span>
                        <span class="font-weight-bold font-large-2 text-danger">{!! number_format($contract->remaining_amount, 0) !!}</span>
                    </div>
                </div>
            </div>

            <!-- Total Amount Strip -->
            <div class="stat-section mb-2 p-2 rounded bg-light-primary-opacity text-center">
                <span class="sidebar-meta-label text-muted font-medium-1 mr-2">{!! __('contracts.total_amount') !!}:</span>
                <span class="font-weight-bold font-large-1 text-primary">{!! number_format($contract->total_amount, 0) !!}</span>
            </div>

            <!-- 2. Creation Meta Info - Dashed Border -->
            <div class="stat-section mb-2 p-2 rounded border-dashed-premium">
                <div class="row no-gutters align-items-center">
                    <div class="col-6 text-center border-right-light">
                        <span class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('general.created_at') !!}</span>
                        <span class="font-weight-bold font-small-1 text-dark">{!! $contract->created_at->format('Y-m-d') !!}</span>
                    </div>
                    <div class="col-6 text-center">
                        <span class="sidebar-meta-label text-muted d-block font-medium-1 mb-1">{!! __('general.created_by') !!}</span>
                        <span class="font-weight-bold font-small-1 text-primary d-block">{!! $contract->creator->name ?? __('general.admin') !!}</span>
                    </div>
                </div>
            </div>

            <!-- 3. Usage Summary -->
            <div class="stat-section mt-1 mb-0 px-1">
                <h6 class="text-muted font-weight-bold mb-1 font-medium-1 text-right-rtl">
                    {!! __('general.usage_summary') !!}
                </h6>

                <div class="stats-grid row no-gutters">
                    <div class="col-4 pr-1">
                        <div class="p-2 rounded text-center bg-light-primary-opacity border-0">
                            <div class="text-muted font-small-2 mb-0">{!! __('payments.payments') !!}</div>
                            <div class="font-weight-bold text-primary font-medium-3">{!! $contract->payments->count() !!}</div>
                        </div>
                    </div>
                    <div class="col-4 px-1">
                        <div class="p-2 rounded text-center bg-light-warning-opacity border-0">
                            <div class="text-muted font-small-2 mb-0">{!! __('cheques.cheques') !!}</div>
                            <div class="font-weight-bold text-warning font-medium-3">{!! $contract->cheques->count() !!}</div>
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="p-2 rounded text-center bg-light-success-opacity border-0">
                            <div class="text-muted font-small-2 mb-0">{!! __('customers.guarantors') !!}</div>
                            <div class="font-weight-bold text-success font-medium-3">{!! optional($contract->customer)->guarantors->count() ?? 0 !!}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
