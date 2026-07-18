<input type="hidden" id="payments-total-count" value="{!! $payments->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                @if(isset($companies))
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">
                    {!! __('companies.company') !!}</th>
                @endif
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('customers.customer') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.amount') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.payment_date') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('payments.method') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('payments.status') !!}</th>
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr id="row{{ $payment->id }}" class="premium-table-row pointer" data-row-title="دفعة #{!! $payment->id !!} | العميل: {!! optional($payment->customer)->name !!}">
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
                                            <span class="detail-info-value font-weight-bold text-success">{!! number_format($payment->amount, 2) !!} {!! currency() !!}</span>
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

                                    @if($payment->company_bank_account_id)
                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-university"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.company_bank_account') !!}</span>
                                            <span class="detail-info-value">{!! optional($payment->companyBankAccount)->bank_name !!} ({{ optional($payment->companyBankAccount)->account_number }})</span>
                                        </div>
                                    </div>
                                    @endif

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
                    @if(isset($companies))
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span>{!! optional($payment->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>
                    @endif
                    <td class="align-middle property-info-td">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.payments.parts.actions')
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="badge badge-light-primary"><i class="fas fa-building mr-25"></i> {!! optional($payment->contract && $payment->contract->property ? $payment->contract->property : null)->name !!}</span>
                            <span class="badge badge-light-info"><i class="fas fa-calendar-alt mr-25"></i> {!! $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '---' !!}</span>
                            <span class="badge badge-light-success"><i class="fas fa-money-bill-wave mr-25"></i> {!! number_format($payment->amount, 2) !!} {!! currency() !!}</span>
                            @php
                                $statusColor = [
                                    'paid' => 'success',
                                    'pending' => 'warning',
                                    'bounced' => 'danger',
                                ][$payment->status] ?? 'secondary';
                            @endphp
                            <span class="badge badge-light-{!! $statusColor !!}"><i class="fas fa-circle mr-25 font-10"></i> {!! __('payments.statuses.' . $payment->status) !!}</span>
                        </div>

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
                            {!! number_format($payment->amount, 2) !!} {!! currency() !!}
                        </span>
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-calendar-alt text-muted mr-1"></i>
                            {!! $payment->payment_date ? $payment->payment_date->format('d-m-Y') : '---' !!}
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
                        @if($payment->cheque_id)
                            <div class="mt-25">
                                <span class="badge badge-light-info border-0 font-10 px-1 py-0" title="{!! __('cheques.cashed_cheque') !!}">
                                    <i class="fas fa-money-check"></i> #{!! optional($payment->cheque)->cheque_number ?? $payment->cheque_id !!}
                                </span>
                            </div>
                        @endif
                        @if($payment->company_bank_account_id)
                            <div class="mt-25">
                                <span class="badge badge-light-info border-0 font-10 px-1 py-0" title="{!! __('cheques.company_bank_account') !!}">
                                    <i class="fas fa-university"></i> {!! optional($payment->companyBankAccount)->bank_name !!}
                                </span>
                            </div>
                        @endif
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
                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-3 text-muted">
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



