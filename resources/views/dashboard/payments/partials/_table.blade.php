<input type="hidden" id="payments-total-count" value="{!! $payments->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('customers.customer') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.amount') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.payment_date') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.method') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('payments.status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 min-w-150">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr id="row{{ $payment->id }}">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary font-22"></i>
                        </span>

                        <!-- Hidden Row Details for Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <div class="premium-modal-header"></div>
                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-calculator font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">#{!! $payment->id !!}</h4>
                                    <span class="modal-role-badge">{!! optional(optional($payment->contract)->customer)->name ?? '---' !!}</span>
                                </div>

                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('payments.amount') !!}</span>
                                            <span class="detail-info-value font-weight-bold text-success">{!! number_format($payment->amount, 2) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('payments.payment_date') !!}</span>
                                            <span class="detail-info-value">{!! $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-credit-card"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('payments.method') !!}</span>
                                            <span class="detail-info-value">{!! __('payments.methods.' . $payment->method) !!}</span>
                                        </div>
                                    </div>

                                    @if($payment->reference_number)
                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-hashtag"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('payments.reference_number') !!}</span>
                                            <span class="detail-info-value">{!! $payment->reference_number !!}</span>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-file-invoice"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.property') !!}</span>
                                            <span class="detail-info-value">{!! $payment->contract && $payment->contract->property ? $payment->contract->property->name : '---' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($payments->currentPage() - 1) * $payments->perPage() !!}
                        </span>
                    </td>
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! optional(optional($payment->contract)->customer)->name ?? '---' !!}</span>
                            <span class="user-email-text text-muted small">{!! optional(optional($payment->contract)->customer)->phone ?? '---' !!}</span>
                        </div>
                    </td>
                    <td class="align-middle d-none d-md-table-cell property-info-td">
                        @if($payment->contract && $payment->contract->property)
                            <div class="user-info-cell">
                                <span class="user-name-text font-weight-bold text-primary">{!! $payment->contract->property->name !!}</span>
                                <span class="user-email-text text-muted small">{!! __('contracts.contract') . ' #' . $payment->contract->id !!}</span>
                            </div>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-pill badge-glow bg-light-primary text-primary font-weight-bold px-3 py-1">
                            {!! number_format($payment->amount, 2) !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-calendar-alt text-muted mr-1"></i>
                            {!! $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="d-flex align-items-center justify-content-center">
                            @php
                                $methodIcons = [
                                    'cash' => 'fa-money-bill-wave',
                                    'bank' => 'fa-university',
                                    'cheque' => 'fa-book',
                                    'online' => 'fa-globe',
                                ];
                                $icon = $methodIcons[$payment->method] ?? 'fa-credit-card';
                            @endphp
                            <i class="fas {!! $icon !!} text-primary mr-1"></i>
                            <span class="text-dark font-weight-bold">{!! __('payments.methods.' . $payment->method) !!}</span>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        @php
                            $statusClass = [
                                'paid' => 'badge-success',
                                'pending' => 'badge-warning',
                                'bounced' => 'badge-danger',
                            ][$payment->status] ?? 'badge-secondary';
                        @endphp
                        <div class="badge badge-pill badge-glow {!! $statusClass !!} premium-badge">
                            {!! __('payments.statuses.' . $payment->status) !!}
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        @include('dashboard.payments.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle mr-1"></i> {!! __('payments.no_payments_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="float-right mt-2 custom-pagination">
    {!! $payments->links() !!}
</div>
