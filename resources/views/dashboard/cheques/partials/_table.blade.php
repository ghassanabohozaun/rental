<input type="hidden" id="cheques-total-count" value="{!! $cheques->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('cheques.cheque_number') !!}</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('customers.customer') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">{!! __('companies.company') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">{!! __('properties.property') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell" style="min-width: 150px;">
                    {!! __('cheques.amount') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('cheques.due_date') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('cheques.is_deposit') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('cheques.status') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 min-w-150">{!! __('general.actions') !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cheques as $cheque)
                <tr id="row{{ $cheque->id }}">
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
                                        <div
                                            class="avatar-circle avatar-size-100 d-inline-flex align-items-center justify-content-center text-white text-uppercase shadow-sm bg-premium-gradient">
                                            <i class="fas fa-money-bill-wave font-40"></i>
                                        </div>
                                    </div>
                                    <h4 class="modal-name-title font-weight-bold">#{!! $cheque->cheque_number !!}</h4>
                                    <span class="modal-role-badge">{!! optional($cheque->customer)->name !!}</span>
                                </div>

                                <div class="modal-info-list mt-2">
                                    <div class="detail-item-modern">
                                        <div class="icon-circle"><i class="fas fa-university"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.bank_name') !!}</span>
                                            <span class="detail-info-value">{!! $cheque->bank_name !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($cheque->company)->name !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-user-tie"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.cheque_owner_name') !!}</span>
                                            <span class="detail-info-value">{!! $cheque->cheque_owner_name !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-money-bill-wave"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.amount') !!}</span>
                                            <span
                                                class="detail-info-value font-weight-bold text-primary">{!! number_format($cheque->amount, 2) !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.due_date') !!}</span>
                                            <span class="detail-info-value">{!! $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---' !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-file-invoice"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('properties.property') !!}</span>
                                            <span class="detail-info-value">{!! $cheque->contract && $cheque->contract->property ? $cheque->contract->property->name : '---' !!}</span>
                                        </div>
                                    </div>

                                    @if ($cheque->notes)
                                        <div class="detail-item-modern mt-1">
                                            <div class="icon-circle"><i class="fas fa-sticky-note"></i></div>
                                            <div class="detail-info-box text-left">
                                                <span class="detail-info-label">{!! __('cheques.notes') !!}</span>
                                                <span
                                                    class="detail-info-value text-muted">{!! $cheque->notes !!}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <span class="badge badge-info badge-pill badge-glow premium-badge-circle">
                            {!! $loop->iteration + ($cheques->currentPage() - 1) * $cheques->perPage() !!}
                        </span>
                    </td>
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $cheque->cheque_number !!}</span>
                            <div class="d-flex flex-column">
                                <span class="user-email-text text-muted small">{!! $cheque->bank_name !!}</span>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! optional($cheque->customer)->name ?? '---' !!}</span>
                            <span class="user-email-text text-muted small">{!! optional($cheque->customer)->phone ?? '---' !!}</span>
                        </div>
                    </td>
                    <td class="align-middle d-none d-md-table-cell property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold text-dark">{!! optional($cheque->company)->name ?? '---' !!}</span>
                        </div>
                    </td>
                    <td class="align-middle d-none d-md-table-cell property-info-td">
                        @if ($cheque->contract && $cheque->contract->property)
                            <div class="user-info-cell">
                                <span
                                    class="user-name-text font-weight-bold text-primary">{!! $cheque->contract->property->name !!}</span>
                                <span class="user-email-text text-muted small">{!! __('contracts.contract') . ' #' . $cheque->contract->id !!}</span>
                            </div>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="d-flex flex-column align-items-center">
                            <span class="font-weight-bold text-primary">
                                {!! number_format($cheque->amount, 2) !!}
                            </span>
                            @if (!$cheque->is_deposit)
                                @php
                                    $percent = $cheque->amount > 0 ? ($cheque->used_amount / $cheque->amount) * 100 : 0;
                                    $barColor =
                                        $percent >= 100 ? 'bg-danger' : ($percent > 0 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <div class="progress progress-sm w-100 cheque-table-progress-thin">
                                    <div class="progress-bar {!! $barColor !!} progress-bar-striped progress-bar-animated"
                                        role="progressbar" style="width: {!! $percent !!}%"></div>
                                </div>
                                <div class="d-flex justify-content-center w-100 cheque-table-available-container">
                                    <span class="text-muted cheque-table-available-text">
                                        <i class="fas fa-coins text-warning mr-1"></i>
                                        {!! number_format($cheque->remaining_amount, 2) !!} {!! __('general.available') !!}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="text-center align-middle text-nowrap">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-calendar-alt text-muted mr-1"></i>
                            {!! $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---' !!}
                        </span>
                    </td>
                    <td class="text-center align-middle">
                        @if ($cheque->is_deposit)
                            <div class="badge badge-pill badge-glow premium-badge badge-indigo-premium">
                                <i class="fas fa-shield-alt"></i> {!! __('cheques.deposit') !!}
                            </div>
                        @else
                            <div class="badge badge-pill badge-glow premium-badge badge-success-premium">
                                <i class="fas fa-money-bill-wave"></i> {!! __('cheques.rent') !!}
                            </div>
                        @endif
                    </td>
                    <td class="text-center align-middle">
                        @php
                            $statusClass =
                                [
                                    'pending' => 'badge-warning',
                                    'cleared' => 'badge-success',
                                    'bounced' => 'badge-danger',
                                    'held' => 'badge-info',
                                ][$cheque->status] ?? 'badge-secondary';
                        @endphp
                        <div class="badge badge-pill badge-glow {!! $statusClass !!} premium-badge">
                            {!! __('cheques.statuses.' . $cheque->status) !!}
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        @include('dashboard.cheques.parts.actions')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle me-25"></i> {!! __('cheques.no_cheques_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="float-right mt-2 custom-pagination">
    {!! $cheques->links() !!}
</div>
