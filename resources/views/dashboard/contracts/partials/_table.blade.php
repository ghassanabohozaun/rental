<input type="hidden" id="contracts-total-count" value="{!! $contracts->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead>
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                @if (isset($companies))
                    <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">
                        {!! __('companies.company') !!}</th>
                @endif
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('contracts.property') !!} &
                    {!! __('contracts.customer') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.rent_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell">{!! __('contracts.paid_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell">{!! __('contracts.remaining_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.payment_cycle') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.deposit_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('general.duration') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('contracts.status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 min-w-140">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contracts as $key => $contract)
                <tr id="row{{ $contract->id }}" class="premium-table-row">
                    <!-- Mobile Details Control -->
                    <td class="text-center align-middle d-lg-none">
                        <span class="details-control pointer">
                            <i class="fas fa-plus-circle text-primary font-22"></i>
                        </span>

                        <!-- Hidden Row Details for AJAX Modal -->
                        <div class="row-details d-none">
                            <div class="modal-details-card">
                                <!-- Header Gradient -->
                                <div class="premium-modal-header"></div>

                                <div class="text-center">
                                    <div class="modal-profile-wrapper">
                                        <div
                                            class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-file-invoice font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">{!! optional($contract->property)->name !!}</h4>
                                    <span class="modal-role-badge">
                                        {!! optional($contract->customer)->name !!}
                                    </span>
                                </div>

                                <!-- Detail Items List -->
                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-fingerprint"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('general.system_id') !!}</span>
                                            <span class="detail-info-value text-muted"># {!! $contract->id !!}</span>
                                        </div>
                                    </div>

                                    @if (isset($companies))
                                        <div class="detail-item-modern mt-1">
                                            <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                            <div class="detail-info-box text-left">
                                                <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                                <span class="detail-info-value">
                                                    <span
                                                        class="badge badge-light-primary border-0">{!! optional($contract->company)->name !!}</span>
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.start_date') !!}</span>
                                            <span class="detail-info-value text-muted">{!! optional($contract->start_date)->format('Y-m-d') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-calendar-times"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.end_date') !!}</span>
                                            <span class="detail-info-value text-muted">{!! optional($contract->end_date)->format('Y-m-d') !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.rent_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-success">{!! number_format($contract->rent_amount, 2) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-bill"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.paid_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-info">{!! number_format($contract->paid_amount, 2) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-balance-scale"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.remaining_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-danger">{!! number_format($contract->remaining_amount, 2) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.deposit_amount') !!}</span>
                                            <div class="detail-info-value d-flex flex-column">
                                                <span class="font-weight-bold text-dark">{!! number_format($contract->deposit_amount, 2) !!}</span>
                                                <div class="d-flex align-items-center gap-1 mt-25">
                                                    <span
                                                        class="badge badge-light-{!! $contract->deposit_type == 'cheque' ? 'primary' : 'success' !!} border-0 font-10 px-1 py-0">
                                                        {!! __('contracts.deposit_type_' . $contract->deposit_type) !!}
                                                    </span>
                                                    @if ($contract->deposit_type == 'cheque' && $contract->insuranceCheque)
                                                        <span class="text-muted small font-11">
                                                            <i class="fas fa-barcode"></i> #{!! $contract->insuranceCheque->cheque_number !!}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-sync"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.payment_cycle') !!}</span>
                                            <span class="detail-info-value">{!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-check-circle"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.status') !!}</span>
                                            <span class="detail-info-value">
                                                <span
                                                    class="badge badge-light-primary border-0">{!! __('contracts.status_' . $contract->status) !!}</span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Desktop ID Badge -->
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($contracts->currentPage() - 1) * $contracts->perPage() !!}
                        </span>
                    </td>

                    <!-- Company (Super Admin Only) -->
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span>{!! optional($contract->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>

                    <!-- Property & Customer Merged -->
                    <td class="align-middle py-3 property-info-td">
                        <div class="user-info-cell">
                            <span class="font-weight-bold font-15 mb-25 truncate-text text-dark-premium">
                                {!! optional($contract->property)->name !!}
                            </span>
                            <span class="text-muted small d-flex align-items-center font-weight-bold">
                                <i class="fas fa-user-circle mr-25 text-primary-premium"></i>
                                {!! optional($contract->customer)->name !!}
                            </span>
                        </div>
                    </td>

                    <!-- Rent Amount -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="premium-financial-box box-primary-light shadow-none">
                            <span class="font-weight-bolder font-16 text-dark-premium d-block">
                                {!! number_format($contract->rent_amount, 2) !!}
                            </span>
                        </div>
                    </td>

                    <!-- Paid Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        <div class="premium-financial-box box-success shadow-none">
                            <span class="font-weight-bold font-15 d-block text-success-premium">
                                {!! number_format($contract->paid_amount, 2) !!}
                            </span>
                        </div>
                    </td>

                    <!-- Remaining Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        @php $hasDebt = $contract->remaining_amount > 0; @endphp
                        <div class="premium-financial-box {{ $hasDebt ? 'box-danger' : 'box-success' }} shadow-none">
                            <span
                                class="font-weight-bold font-15 d-block {{ $hasDebt ? 'text-danger-premium' : 'text-success-premium' }}">
                                {!! number_format($contract->remaining_amount, 2) !!}
                            </span>
                        </div>
                    </td>

                    <!-- Payment Cycle -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        @php
                            $cycleColor = $contract->payment_cycle == 'monthly' ? 'info' : 'success';
                            $cycleIcon = $contract->payment_cycle == 'monthly' ? 'fa-calendar-check' : 'fa-sync';
                        @endphp
                        <div class="d-inline-flex flex-column align-items-center">
                            <span
                                class="badge badge-light-{!! $cycleColor !!} border-0 px-2 py-1 mb-25 payment-cycle-pill">
                                <i class="fas {!! $cycleIcon !!} mr-25"></i> {!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}
                            </span>
                        </div>
                    </td>

                    <!-- Insurance / Deposit -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        @if ($contract->deposit_amount > 0)
                            <div class="d-flex flex-column align-items-center">
                                {{-- Deposit Type Badge --}}
                                @php
                                    $typeColor = $contract->deposit_type == 'cheque' ? 'primary' : 'success';
                                    $typeIcon =
                                        $contract->deposit_type == 'cheque' ? 'fa-money-check' : 'fa-money-bill-wave';
                                @endphp
                                <span
                                    class="badge badge-light-{!! $typeColor !!} border-0 font-10 mb-25 px-1 py-0 shadow-sm badge-premium">
                                    <i class="fas {!! $typeIcon !!} font-12"></i> {!! __('contracts.deposit_type_' . $contract->deposit_type) !!}
                                </span>

                                {{-- Amount --}}
                                <span class="font-weight-bold font-15 mb-25 text-dark-premium">
                                    {!! number_format($contract->deposit_amount, 2) !!}
                                </span>

                                {{-- Cheque Number & Status --}}
                                @if ($contract->deposit_type == 'cheque' && $contract->insuranceCheque)
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="text-primary-premium mb-25 cheque-num-sm"
                                            title="{!! __('cheques.cheque_number') !!}">
                                            <i class="fas fa-barcode"></i> {!! $contract->insuranceCheque->cheque_number !!}
                                        </span>
                                @php
                                    $dStatusInfo = [
                                        'held' => ['class' => 'badge-info-premium', 'icon' => 'fas fa-pause-circle'],
                                        'returned' => ['class' => 'badge-danger-premium', 'icon' => 'fas fa-undo'],
                                        'used' => ['class' => 'badge-success-premium', 'icon' => 'fas fa-check-circle'],
                                    ][$contract->deposit_status] ?? ['class' => 'badge-secondary', 'icon' => 'fas fa-info-circle'];
                                @endphp
                                <div class="badge badge-pill badge-glow premium-badge-sm {!! $dStatusInfo['class'] !!} py-25 px-1 mt-25">
                                    <i class="{!! $dStatusInfo['icon'] !!} font-10 mr-25"></i> {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                                </div>
@else
                                @php
                                    $dStatusInfo = [
                                        'held' => ['class' => 'badge-info-premium', 'icon' => 'fas fa-pause-circle'],
                                        'returned' => ['class' => 'badge-danger-premium', 'icon' => 'fas fa-undo'],
                                        'used' => ['class' => 'badge-success-premium', 'icon' => 'fas fa-check-circle'],
                                    ][$contract->deposit_status] ?? ['class' => 'badge-secondary', 'icon' => 'fas fa-info-circle'];
                                @endphp
                                <div class="badge badge-pill badge-glow premium-badge-sm {!! $dStatusInfo['class'] !!} py-25 px-1 mt-25">
                                    <i class="{!! $dStatusInfo['icon'] !!} font-10 mr-25"></i> {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                                </div>
@endif
                            </div>
                        @else
                            <span class="badge badge-secondary border-0 px-2 py-25 no-deposit-badge">
                                <i class="fas fa-minus-circle"></i> {!! __('contracts.no_deposit') !!}
                            </span>
                        @endif
                    </td>

                    <!-- Duration & Dates -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center text-dark font-weight-bold mb-1 font-13">
                                <i class="fas fa-history text-primary mr-50 font-16"></i> {!! $contract->duration_label !!}
                            </div>
                            <div
                                class="date-range-badge d-flex align-items-center rounded-pill px-2 py-25 date-range-pill">
                                <span class="small font-weight-bold text-muted">{!! $contract->start_date ? $contract->start_date->format('Y-m-d') : '---' !!}</span>
                                <i class="fas fa-long-arrow-{!! app()->getLocale() == 'ar' ? 'left' : 'right' !!} mx-1 text-primary"></i>
                                <span class="small font-weight-bold text-muted">{!! $contract->end_date ? $contract->end_date->format('Y-m-d') : '---' !!}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="text-center align-middle py-3">
                        @php
                            $statusColor = 'primary';
                            if ($contract->status == 'ended') {
                                $statusColor = 'warning';
                            }
                            if ($contract->status == 'cancelled') {
                                $statusColor = 'danger';
                            }
                        @endphp
                        <span
                            class="badge badge-pill badge-light-{!! $statusColor !!} border-0 px-2 py-1 font-weight-bold shadow-none status-badge-min">
                            <i class="fas fa-circle mr-25 font-10"></i> {!! __('contracts.status_' . $contract->status) !!}
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="text-center align-middle">
                        @include('dashboard.contracts.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center p-4 text-muted">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-info-circle mb-1 font-40 opacity-5"></i>
                            <span>{!! __('contracts.no_contracts_found') !!}</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="float-right mt-2 custom-pagination">
        {!! $contracts->links() !!}
    </div>
</div>
