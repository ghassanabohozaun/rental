<div class="premium-details-container">
    {{-- Status Header --}}
    @php
        $statusClass = [
            'paid' => 'bg-light-success text-success',
            'pending' => 'bg-light-warning text-warning',
            'bounced' => 'bg-light-danger text-danger',
        ][$payment->status] ?? 'bg-light-secondary text-secondary';
    @endphp
    
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h6 class="text-muted mb-1">{!! __('payments.payment_id') !!}</h6>
            <h4 class="font-weight-bold text-dark mb-0">#{!! $payment->id !!}</h4>
        </div>
        <div class="badge badge-pill badge-glow px-4 py-2 {!! $statusClass !!}" style="font-size: 14px; font-weight: bold;">
            {!! __('payments.statuses.' . $payment->status) !!}
        </div>
    </div>

    <div class="row">
        {{-- Section 1: Financial Info --}}
        <div class="col-md-6">
            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-primary text-primary mr-3">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('payments.amount') !!}</span>
                        <span class="detail-value font-weight-bold text-primary h5 mb-0">{!! number_format($payment->amount, 2) !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-info text-info mr-3">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('payments.payment_date') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '---' !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-secondary text-secondary mr-3">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('payments.reference_number') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $payment->reference_number ?? '---' !!}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Method & Source Info --}}
        <div class="col-md-6 border-left">
            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-success text-success mr-3">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('payments.method') !!}</span>
                        <span class="detail-value font-weight-bold text-dark text-capitalize">{!! __('payments.methods.' . $payment->method) !!}</span>
                    </div>
                </div>
            </div>

            @if($payment->method === 'cheque' && $payment->cheque)
                <div class="detail-group mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="detail-icon bg-light-warning text-warning mr-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <span class="detail-label d-block text-muted small">{!! __('payments.cheque') !!}</span>
                            <span class="detail-value font-weight-bold text-dark">#{!! $payment->cheque->cheque_number !!}</span>
                            <span class="d-block text-muted x-small">{!! $payment->cheque->bank_name !!}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-info text-info mr-3">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('general.created_by') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! optional($payment->creator)->name ?? '---' !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 3: Contract & Customer (Full Width Card) --}}
    <div class="mt-2">
        <div class="premium-detail-card bg-light rounded p-3">
            <div class="row align-items-center">
                <div class="col-md-6 border-right">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-white text-primary rounded-circle mr-3 p-2 shadow-sm">
                            <i class="fas fa-user h4 mb-0"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted small">{!! __('customers.customer') !!}</span>
                            <span class="font-weight-bold text-dark">{!! optional(optional($payment->contract)->customer)->name ?? '---' !!}</span>
                            <span class="d-block text-muted x-small">{!! optional(optional($payment->contract)->customer)->phone ?? '' !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center pl-md-3 mt-3 mt-md-0">
                        <div class="avatar bg-white text-info rounded-circle mr-3 p-2 shadow-sm">
                            <i class="fas fa-file-invoice h4 mb-0"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted small">{!! __('contracts.contract') !!}</span>
                            <span class="font-weight-bold text-dark">#{!! optional($payment->contract)->id ?? '---' !!}</span>
                            @if($payment->contract && $payment->contract->property)
                                <span class="d-block text-muted x-small">{!! $payment->contract->property->name !!}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 4: Notes --}}
    @if($payment->notes)
        <div class="mt-4 pt-3 border-top">
            <h6 class="text-muted mb-2 font-weight-bold"><i class="fas fa-sticky-note mr-1 text-primary"></i> {!! __('payments.notes') !!}</h6>
            <p class="text-dark bg-light p-3 rounded border-left-primary border-left-3">
                {!! nl2br(e($payment->notes)) !!}
            </p>
        </div>
    @endif
</div>

<style>
    .premium-details-container { padding: 10px; }
    .detail-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .bg-light-primary { background-color: rgba(30, 159, 242, 0.1) !important; }
    .bg-light-success { background-color: rgba(40, 208, 148, 0.1) !important; }
    .bg-light-danger { background-color: rgba(255, 73, 97, 0.1) !important; }
    .bg-light-warning { background-color: rgba(255, 145, 73, 0.1) !important; }
    .bg-light-info { background-color: rgba(0, 184, 212, 0.1) !important; }
    .border-left-primary { border-left-color: #1e9ff2 !important; }
    .x-small { font-size: 11px; }
</style>


