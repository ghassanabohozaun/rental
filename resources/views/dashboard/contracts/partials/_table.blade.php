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
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse ($contracts as $key => $contract)
                <tr id="row{{ $contract->id }}" class="premium-table-row pointer" data-row-title="العقد #{!! $contract->id !!} | {!! optional($contract->customer)->name !!}">
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
                                        @if (optional($contract->customer)->tenant_type && strtolower(optional($contract->customer)->tenant_type) == 'company')
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
                                            <span class="detail-info-value text-muted">{!! $contract->duration_label !!}
                                                ({!! optional($contract->start_date)->format('d-m-Y') !!} - {!! optional($contract->end_date)->format('d-m-Y') !!})
                                            </span>
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
                    @if (isset($companies))
                        <td class="text-center align-middle d-none d-md-table-cell">
                            <span class="font-weight-bold text-dark">
                                {!! optional($contract->company)->name ?? __('general.all_companies') !!}
                            </span>
                        </td>
                    @endif

                    <!-- Property & Customer Merged -->
                    <td class="align-middle min-w-300">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.contracts.parts.actions')
                        </div>

                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="text-muted"><i class="far fa-building mr-25 opacity-5"></i> {!! optional($contract->property)->name !!}</span>
                            <span class="text-muted mx-50">|</span>
                            <span class="text-muted"><i class="far fa-calendar-alt mr-25 opacity-5"></i> {!! $contract->start_date ? $contract->start_date->format('d-m-Y') : '---' !!} <i class="fas fa-arrow-{!! app()->getLocale() == 'ar' ? 'left' : 'right' !!} mx-1 opacity-5"></i> {!! $contract->end_date ? $contract->end_date->format('d-m-Y') : '---' !!}</span>
                            <span class="text-muted mx-50">|</span>
                            <span class="font-weight-bold text-dark"><i class="fas fa-money-bill-wave mr-25 text-muted opacity-5"></i> {!! number_format($contract->total_amount, 2) !!} <small class="text-muted font-weight-normal">{!! currency() !!}</small></span>
                            <span class="text-muted mx-50">|</span>
                            @php
                                $statusColor = [
                                    'draft' => 'text-secondary',
                                    'active' => 'text-success',
                                    'expired' => 'text-danger',
                                    'canceled' => 'text-warning',
                                ][$contract->status] ?? 'text-secondary';
                            @endphp
                            <span class="{!! $statusColor !!} font-weight-bold"><i class="fas fa-circle mr-25 font-10"></i> {!! __('contracts.status_' . $contract->status) !!}</span>
                        </div>

                        <div class="d-flex flex-column">
                            <span class="font-weight-bold font-15 mb-25 truncate-text text-dark">
                                {!! optional($contract->property)->name !!}
                            </span>
                            <div class="mt-50 d-flex flex-column align-items-start" style="gap: 4px;">
                                @if (optional($contract->customer)->tenant_type && strtolower(optional($contract->customer)->tenant_type) == 'company')
                                    <span class="text-muted" title="{!! __('companies.company') !!}" style="font-size: 0.85rem;">
                                        <i class="far fa-building mr-50 opacity-5"></i> {!! optional($contract->customer)->company_name !!}
                                    </span>
                                    <span class="text-muted mt-25" title="{!! __('customers.representative') !!}" style="font-size: 0.8rem;">
                                        {!! optional($contract->customer)->name !!}
                                    </span>
                                @else
                                    <span class="text-muted" style="font-size: 0.85rem;">
                                        <i class="far fa-user mr-50 opacity-5"></i> {!! optional($contract->customer)->name !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Duration & Dates -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <div class="d-flex flex-column align-items-center">
                            <span class="font-weight-bold text-dark mb-25">{!! $contract->duration_label !!}</span>
                            <span class="text-muted" style="font-size: 0.8rem;">
                                {!! $contract->start_date ? $contract->start_date->format('d-m-Y') : '---' !!} 
                                <i class="fas fa-arrow-{!! app()->getLocale() == 'ar' ? 'left' : 'right' !!} mx-1 opacity-5"></i> 
                                {!! $contract->end_date ? $contract->end_date->format('d-m-Y') : '---' !!}
                            </span>
                        </div>
                    </td>

                    <!-- Rent Amount -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <span class="font-weight-bold text-dark d-block">
                            {!! number_format($contract->rent_amount, 2) !!} <small class="text-muted font-weight-normal">{!! currency() !!}</small>
                        </span>
                    </td>

                    <!-- Total Rent Amount -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <span class="font-weight-bold text-dark d-block">
                            {!! number_format($contract->total_amount, 2) !!} <small class="text-muted font-weight-normal">{!! currency() !!}</small>
                        </span>
                    </td>

                    <!-- Paid Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        <span class="font-weight-bold text-dark d-block">
                            {!! number_format($contract->paid_amount, 2) !!} <small class="text-muted font-weight-normal">{!! currency() !!}</small>
                        </span>
                    </td>

                    <!-- Remaining Amount -->
                    <td class="text-center align-middle d-none d-xl-table-cell py-3">
                        @php $hasDebt = $contract->remaining_amount > 0; @endphp
                        <span class="font-weight-bold d-block {{ $hasDebt ? 'text-danger' : 'text-dark' }}">
                            {!! number_format($contract->remaining_amount, 2) !!} <small class="{{ $hasDebt ? 'text-danger opacity-75' : 'text-muted' }} font-weight-normal">{!! currency() !!}</small>
                        </span>
                    </td>

                    <!-- Payment Cycle -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        <span class="text-dark">
                            {!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}
                        </span>
                    </td>

                    <!-- Insurance / Deposit -->
                    <td class="text-center align-middle d-none d-lg-table-cell py-3">
                        @if ($contract->deposit_amount > 0)
                            <div class="d-flex flex-column align-items-center">
                                <span class="font-weight-bold text-dark d-block">
                                    {!! number_format($contract->deposit_amount, 2) !!} <small class="text-muted font-weight-normal">{!! currency() !!}</small>
                                </span>
                                <span class="text-muted mt-25" style="font-size: 0.8rem;">
                                    {!! __('contracts.deposit_type_' . $contract->deposit_type) !!}
                                </span>
                                @if ($contract->deposit_type == 'cheque' && $contract->insuranceCheque)
                                    <span class="text-muted mt-25" style="font-size: 0.75rem;">
                                        #{!! $contract->insuranceCheque->cheque_number !!}
                                    </span>
                                @endif
                            </div>
                        @else
                            <span class="text-muted" style="font-size: 0.85rem;">
                                ---
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

                    <!-- Actions Column Removed -->
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
    <div class="float-right mt-2 custom-pagination">
        {!! $contracts->appends(request()->except('_ajax'))->links() !!}
    </div>
</div>
