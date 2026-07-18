<input type="hidden" id="cheques-total-count" value="{!! $cheques->total() !!}">
<div class="table-responsive">
    <table class="table table-hover mb-0" id='myTable'>
        <thead class="bg-white">
            <tr>
                <th class="text-center d-lg-none align-middle py-3 border-top-0">#</th> <!-- For Details Control -->
                <th class="text-center d-none d-lg-table-cell align-middle py-3 border-top-0">#</th>
                @if(isset($companies))
                <th class="text-center align-middle py-3 border-top-0 d-none d-md-table-cell">
                    {!! __('companies.company') !!}</th>
                @endif
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('cheques.cheque_number') !!}</th>
                <th class="align-middle py-3 border-top-0 property-info-td">{!! __('customers.customer') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">
                    {!! __('properties.property') !!}</th>
                <th class="align-middle py-3 border-top-0 d-none d-md-table-cell property-info-td">
                    {!! __('cheques.company_bank_account') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell" style="min-width: 150px;">
                    {!! __('cheques.amount') !!}</th>
                <th class="text-center align-middle py-3 border-top-0 d-none d-lg-table-cell">{!! __('cheques.due_date') !!}
                </th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('cheques.is_deposit') !!}</th>
                <th class="text-center align-middle py-3 border-top-0">{!! __('cheques.status') !!}</th>
                <!-- Actions Column Removed for Bottom Action Bar -->
            </tr>
        </thead>
        <tbody>
            @forelse($cheques as $cheque)
                <tr id="row{{ $cheque->id }}" class="premium-table-row pointer" data-row-title="شيك #{!! $cheque->cheque_number !!} | {!! optional($cheque->customer)->name !!}">
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

                                    @if(isset($companies))
                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('companies.company') !!}</span>
                                            <span class="detail-info-value">{!! optional($cheque->company)->name !!}</span>
                                        </div>
                                    </div>
                                    @endif

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
                                                class="detail-info-value font-weight-bold text-primary">{!! number_format($cheque->amount, 2) !!}
                                                {!! currency() !!}</span>
                                        </div>
                                    </div>

                                    <div class="detail-item-modern mt-1">
                                        <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="detail-info-box text-left">
                                            <span class="detail-info-label">{!! __('cheques.due_date') !!}</span>
                                            <span class="detail-info-value">{!! $cheque->due_date ? $cheque->due_date->format('d-m-Y') : '---' !!}</span>
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
                    @if(isset($companies))
                    <td class="text-center align-middle d-none d-md-table-cell">
                        <div class="company-chip">
                            <i class="fas fa-briefcase"></i>
                            <span>{!! optional($cheque->company)->name ?? __('general.all_companies') !!}</span>
                        </div>
                    </td>
                    @endif
                    <td class="align-middle property-info-td">
                        <div class="user-info-cell">
                            <span class="user-name-text font-weight-bold">{!! $cheque->cheque_number !!}</span>
                            <div class="d-flex flex-column">
                                <span class="user-email-text text-muted small">{!! $cheque->bank_name !!}</span>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle py-3">
                        <!-- Hidden Actions for Bottom Bar -->
                        <div class="row-actions-html d-none">
                            @include('dashboard.cheques.parts.actions')
                        </div>
                        
                        <!-- Hidden Subtitle for Bottom Bar -->
                        <div class="row-subtitle-html d-none">
                            <span class="badge badge-light-primary"><i class="fas fa-building mr-25"></i> {!! optional($cheque->contract && $cheque->contract->property ? $cheque->contract->property : null)->name !!}</span>
                            <span class="badge badge-light-info"><i class="fas fa-calendar-alt mr-25"></i> مستحق في: {!! $cheque->due_date ? $cheque->due_date->format('d-m-Y') : '---' !!}</span>
                            <span class="badge badge-light-success"><i class="fas fa-money-bill-wave mr-25"></i> {!! number_format($cheque->amount, 2) !!} {!! currency() !!}</span>
                            @php
                                $statusColor = [
                                    'pending' => 'warning',
                                    'cleared' => 'success',
                                    'returned' => 'danger',
                                    'bounced' => 'danger',
                                    'held' => 'info',
                                ][$cheque->status] ?? 'secondary';
                            @endphp
                            <span class="badge badge-light-{!! $statusColor !!}"><i class="fas fa-circle mr-25 font-10"></i> {!! __('cheques.statuses.' . $cheque->status) !!}</span>
                        </div>

                        <div class="d-flex flex-column">
                            <span class="user-name-text font-weight-bold">{!! optional($cheque->customer)->name ?? '---' !!}</span>
                            <span class="user-email-text text-muted small">{!! optional($cheque->customer)->phone ?? '---' !!}</span>
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
                    <td class="align-middle d-none d-md-table-cell property-info-td">
                        @if ($cheque->companyBankAccount)
                            <div class="user-info-cell">
                                <span class="user-name-text font-weight-bold text-dark">{!! $cheque->companyBankAccount->bank_name !!}</span>
                                <span class="user-email-text text-muted small">{!! $cheque->companyBankAccount->account_number !!}</span>
                            </div>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>
                    <td class="text-center align-middle d-none d-lg-table-cell">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <span class="font-weight-bolder text-primary" style="font-size: 1.05rem; line-height: 1;">
                                {!! number_format($cheque->amount, 2) !!} {!! currency() !!}
                            </span>
                            @if (!$cheque->is_deposit)
                                @php
                                    $percent = $cheque->amount > 0 ? ($cheque->used_amount / $cheque->amount) * 100 : 0;
                                    $barColor =
                                        $percent >= 100 ? 'bg-danger' : ($percent > 0 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <div class="w-100 mt-1" style="max-width: 100px;">
                                    <div class="progress mb-1"
                                        style="height: 4px; border-radius: 2px; background-color: #f1f1f1; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                                        <div class="progress-bar {!! $barColor !!}" role="progressbar"
                                            style="width: {!! $percent !!}%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center"
                                        style="font-size: 0.75rem; line-height: 1;">
                                        <span class="text-muted"><i class="fas fa-coins text-warning"
                                                style="font-size: 10px;"></i></span>
                                        <span class="font-weight-bold text-dark">{!! number_format($cheque->remaining_amount, 2) !!}
                                            {!! currency() !!} <small
                                                class="text-muted">{!! __('general.available') !!}</small></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="text-center align-middle text-nowrap">
                        <span class="text-dark font-weight-bold">
                            <i class="fas fa-calendar-alt text-muted mr-1"></i>
                            {!! $cheque->due_date ? $cheque->due_date->format('d-m-Y') : '---' !!}
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
                            $statusInfo = [
                                'pending' => ['class' => 'badge-warning-premium', 'icon' => 'fas fa-clock'],
                                'cleared' => ['class' => 'badge-success-premium', 'icon' => 'fas fa-check-circle'],
                                'bounced' => ['class' => 'badge-danger-premium', 'icon' => 'fas fa-times-circle'],
                                'held' => ['class' => 'badge-info-premium', 'icon' => 'fas fa-pause-circle'],
                                'returned' => ['class' => 'badge-danger-premium', 'icon' => 'fas fa-undo'],
                            ][$cheque->status] ?? [
                                'class' => 'badge-secondary-premium',
                                'icon' => 'fas fa-info-circle',
                            ];
                        @endphp
                        <div class="badge badge-pill badge-glow premium-badge {!! $statusInfo['class'] !!}">
                            <i class="{!! $statusInfo['icon'] !!}"></i> {!! __('cheques.statuses.' . $cheque->status) !!}
                        </div>
                    </td>
                    <!-- Actions Column Removed -->
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle me-25"></i> {!! __('cheques.no_cheques_found') !!}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="float-right mt-2 custom-pagination">
    {!! $cheques->appends(request()->except('_ajax'))->links() !!}
</div>

