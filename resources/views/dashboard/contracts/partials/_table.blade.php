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
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('general.duration') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.rent_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.total_rent_value') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell">{!! __('contracts.paid_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-xl-table-cell">{!! __('contracts.remaining_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.payment_cycle') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('contracts.deposit_amount') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('contracts.status') !!}</th>
                @if (auth()->user()->can('contracts_read') ||
                        auth()->user()->can('contracts_update') ||
                        auth()->user()->can('contracts_delete'))
                    <th class="text-center align-middle py-3 border-top-0 min-w-140 sticky-actions">
                        {!! __('general.actions') !!}</th>
                @endif
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
                                        @if(optional($contract->customer)->tenant_type && strtolower(optional($contract->customer)->tenant_type) == 'company')
                                            <i class="fas fa-building mr-1"></i> {!! optional($contract->customer)->company_name !!}
                                            <span class="mx-1">|</span>
                                            <i class="fas fa-user-tie mr-1"></i> {!! optional($contract->customer)->name !!}
                                        @else
                                            <i class="fas fa-user-circle mr-1"></i> {!! optional($contract->customer)->name !!}
                                        @endif
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
                                            <span class="detail-info-label">{!! __('general.duration') !!}</span>
                                            <span class="detail-info-value text-muted">{!! $contract->duration_label !!} ({!! optional($contract->start_date)->format('Y-m-d') !!} - {!! optional($contract->end_date)->format('Y-m-d') !!})</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.rent_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-success">{!! number_format($contract->rent_amount, 2) !!}
                                                {!! currency() !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-check-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.total_rent_value') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-info">{!! number_format($contract->total_amount, 2) !!}
                                                {!! currency() !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-bill"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.paid_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-info">{!! number_format($contract->paid_amount, 2) !!}
                                                {!! currency() !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-balance-scale"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.remaining_amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-danger">{!! number_format($contract->remaining_amount, 2) !!}
                                                {!! currency() !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('contracts.deposit_amount') !!}</span>
                                            <div class="detail-info-value d-flex flex-column">
                                                <span class="font-weight-bold text-dark">{!! number_format($contract->deposit_amount, 2) !!}
                                                    {!! currency() !!}</span>
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
                    @if(isset($companies))
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span>{!! optional($contract->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>
                    @endif

                    <!-- Property & Customer Merged -->
                    <td class="align-middle py-3 property-info-td">
                        <div class="user-info-cell">
                            <span class="font-weight-bold font-15 mb-25 truncate-text text-dark-premium">
                                {!! optional($contract->property)->name !!}
                            </span>
                            <span class="text-muted small d-flex flex-column align-items-start font-weight-bold">
                                @if(optional($contract->customer)->tenant_type && strtolower(optional($contract->customer)->tenant_type) == 'company')
                                    <span class="d-flex align-items-center mb-25" title="{!! __('companies.company') !!}">
                                        <i class="fas fa-building mr-50 text-primary-premium"></i>
                                        {!! optional($contract->customer)->company_name !!}
                                    </span>
                                    <span class="d-flex align-items-center text-secondary" title="{!! __('customers.representative') !!}">
                                        <i class="fas fa-user-tie mr-50"></i>
                                        {!! optional($contract->customer)->name !!}
                                    </span>
                                @else
                                    <span class="d-flex align-items-center">
                                        <i class="fas fa-user-circle mr-50 text-primary-premium"></i>
                                        {!! optional($contract->customer)->name !!}
                                    </span>
                                @endif
                            </span>
                        </div>
                    </td>

                    <!-- Duration & Dates -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="contract-duration-wrapper">
                            <div class="duration-label-badge">
                                <i class="fas fa-history text-primary"></i> <span>{!! $contract->duration_label !!}</span>
                            </div>
                            <div class="date-range-badge">
                                <span class="date-text">{!! $contract->start_date ? $contract->start_date->format('Y-m-d') : '---' !!}</span>
                                <i class="fas fa-long-arrow-alt-{!! app()->getLocale() == 'ar' ? 'left' : 'right' !!} text-primary date-arrow"></i>
                                <span class="date-text">{!! $contract->end_date ? $contract->end_date->format('Y-m-d') : '---' !!}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Rent Amount -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="premium-financial-box box-primary-light shadow-none">
                            <span class="font-weight-bolder font-16 text-dark-premium d-block">
                                {!! number_format($contract->rent_amount, 2) !!} {!! currency() !!}
                            </span>
                        </div>
                    </td>

                    <!-- Total Rent Amount -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="premium-financial-box box-info-light shadow-none">
                            <span class="font-weight-bolder font-16 text-info-premium d-block">
                                {!! number_format($contract->total_amount, 2) !!} {!! currency() !!}
                            </span>
                        </div>
                    </td>

                    <!-- Paid Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        <div class="premium-financial-box box-success shadow-none">
                            <span class="font-weight-bold font-15 d-block text-success-premium">
                                {!! number_format($contract->paid_amount, 2) !!} {!! currency() !!}
                            </span>
                        </div>
                    </td>

                    <!-- Remaining Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        @php $hasDebt = $contract->remaining_amount > 0; @endphp
                        <div class="premium-financial-box {{ $hasDebt ? 'box-danger' : 'box-success' }} shadow-none">
                            <span
                                class="font-weight-bold font-15 d-block {{ $hasDebt ? 'text-danger-premium' : 'text-success-premium' }}">
                                {!! number_format($contract->remaining_amount, 2) !!} {!! currency() !!}
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
                                    {!! number_format($contract->deposit_amount, 2) !!} {!! currency() !!}
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
                                                'held' => [
                                                    'class' => 'badge-info-premium',
                                                    'icon' => 'fas fa-pause-circle',
                                                ],
                                                'returned' => [
                                                    'class' => 'badge-danger-premium',
                                                    'icon' => 'fas fa-undo',
                                                ],
                                                'used' => [
                                                    'class' => 'badge-success-premium',
                                                    'icon' => 'fas fa-check-circle',
                                                ],
                                            ][$contract->deposit_status] ?? [
                                                'class' => 'badge-secondary',
                                                'icon' => 'fas fa-info-circle',
                                            ];
                                        @endphp
                                        <div
                                            class="badge badge-pill badge-glow premium-badge-sm {!! $dStatusInfo['class'] !!} py-25 px-1 mt-25">
                                            <i class="{!! $dStatusInfo['icon'] !!} font-10 mr-25"></i>
                                            {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                                        </div>
                                    @else
                                        @php
                                            $dStatusInfo = [
                                                'held' => [
                                                    'class' => 'badge-info-premium',
                                                    'icon' => 'fas fa-pause-circle',
                                                ],
                                                'returned' => [
                                                    'class' => 'badge-danger-premium',
                                                    'icon' => 'fas fa-undo',
                                                ],
                                                'used' => [
                                                    'class' => 'badge-success-premium',
                                                    'icon' => 'fas fa-check-circle',
                                                ],
                                            ][$contract->deposit_status] ?? [
                                                'class' => 'badge-secondary',
                                                'icon' => 'fas fa-info-circle',
                                            ];
                                        @endphp
                                        <div
                                            class="badge badge-pill badge-glow premium-badge-sm {!! $dStatusInfo['class'] !!} py-25 px-1 mt-25">
                                            <i class="{!! $dStatusInfo['icon'] !!} font-10 mr-25"></i>
                                            {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                                        </div>
                                @endif
                            </div>
                        @else
                            <span class="badge badge-secondary border-0 px-2 py-25 no-deposit-badge">
                                <i class="fas fa-minus-circle"></i> {!! __('contracts.no_deposit') !!}
                            </span>
                        @endif
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
                    @if (auth()->user()->can('contracts_read') ||
                            auth()->user()->can('contracts_update') ||
                            auth()->user()->can('contracts_delete'))
                        <td class="text-center align-middle sticky-actions">
                            @include('dashboard.contracts.parts.actions')
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-4 text-muted">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-info-circle mb-1 font-40 opacity-5"></i>
                            <span>{!! __('contracts.no_contracts_found') !!}</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="mt-2 text-center">
        <div class="d-inline-block">
            {!! $contracts->appends(request()->except('_ajax'))->links() !!}
        </div>
    </div>
</div>
