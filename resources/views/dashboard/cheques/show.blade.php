<div class="premium-details-container">
    {{-- Status Header --}}
    @php
        $statusClass = [
            'pending' => 'bg-light-warning text-warning',
            'cleared' => 'bg-light-success text-success',
            'bounced' => 'bg-light-danger text-danger',
            'held' => 'bg-light-info text-info',
        ][$cheque->status] ?? 'bg-light-secondary text-secondary';
    @endphp
    
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h6 class="text-muted mb-1">{!! __('cheques.cheque_number') !!}</h6>
            <h4 class="font-weight-bold text-dark mb-0">#{!! $cheque->cheque_number !!}</h4>
        </div>
        <div class="badge badge-pill badge-glow px-4 py-2 {!! $statusClass !!} cheque-status-lg">
            {!! __('cheques.statuses.' . $cheque->status) !!}
        </div>
    </div>

    <div class="row">
        {{-- Section 1: Financial & Basic Info --}}
        <div class="col-md-6">
            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-primary text-primary mr-3">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.amount') !!}</span>
                        <span class="detail-value font-weight-bold text-primary h5 mb-0">{!! number_format($cheque->amount, 2) !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-info text-info mr-3">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.issue_date') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $cheque->issue_date ? $cheque->issue_date->format('Y-m-d') : '---' !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-danger text-danger mr-3">
                        <i class="fas fa-calendar-alt-check"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.due_date') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---' !!}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Bank Info --}}
        <div class="col-md-6 border-left">
            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-success text-success mr-3">
                        <i class="fas fa-university"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.bank_name') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $cheque->bank_name !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-warning text-warning mr-3">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.cheque_owner_name') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">{!! $cheque->cheque_owner_name !!}</span>
                    </div>
                </div>
            </div>

            <div class="detail-group mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="detail-icon bg-light-secondary text-secondary mr-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <span class="detail-label d-block text-muted small">{!! __('cheques.is_deposit') !!}</span>
                        <span class="detail-value font-weight-bold text-dark">
                            {!! $cheque->is_deposit ? __('general.yes') : __('general.no') !!}
                        </span>
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
                            <span class="font-weight-bold text-dark">{!! optional($cheque->customer)->name ?? '---' !!}</span>
                            <span class="d-block text-muted x-small">{!! optional($cheque->customer)->phone ?? '' !!}</span>
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
                            <span class="font-weight-bold text-dark">#{!! optional($cheque->contract)->id ?? '---' !!}</span>
                            @if($cheque->contract && $cheque->contract->property)
                                <span class="d-block text-muted x-small">{!! $cheque->contract->property->name !!}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 4: Notes --}}
    @if($cheque->notes)
        <div class="mt-4 pt-3 border-top">
            <h6 class="text-muted mb-2 font-weight-bold"><i class="fas fa-sticky-note mr-1 text-primary"></i> {!! __('cheques.notes') !!}</h6>
            <p class="text-dark bg-light p-3 rounded border-left-primary border-left-3">
                {!! nl2br(e($cheque->notes)) !!}
            </p>
        </div>
    @endif
</div>



