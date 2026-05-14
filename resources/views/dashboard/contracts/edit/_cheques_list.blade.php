<div class="card premium-card shadow-lg border-0 mt-3 premium-card-anim">
    <div class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
            <i class="fas fa-money-check text-primary mr-2 icon-size-16"></i>
            {!! __('cheques.cheques') !!}
        </h6>
        @can('cheques_create')
            <a href="{!! route('dashboard.cheques.create') !!}?contract_id={!! $contract->id !!}&company_id={!! $contract->company_id !!}&is_deposit=0"
                class="btn btn-sm btn-light-warning font-weight-bolder hover-scale shadow-none">
                <i class="fas fa-plus-circle mr-50"></i>
                {!! __('cheques.add_cheque') !!}
            </a>
        @endcan
    </div>

    <div class="card-content">
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="table table-hover mb-0 premium-table">
                    <thead>
                        <tr class="text-muted small text-uppercase">
                            <th class="border-top-0 py-2">{!! __('cheques.cheque_number') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.bank_name') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.amount') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.due_date') !!}</th>
                            <th class="border-top-0 py-2 text-center">{!! __('cheques.status') !!}</th>
                            <th class="border-top-0 py-2">{!! __('cheques.cheque_type') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contract->cheques as $cheque)
                            <tr class="premium-table-row">
                                <td class="py-2 font-weight-bold text-dark">#{!! $cheque->cheque_number !!}</td>
                                <td class="py-2 text-muted small font-weight-bold">{!! $cheque->bank_name !!}</td>
                                <td class="py-2">
                                    <span
                                        class="font-weight-bolder text-primary-premium">{!! number_format($cheque->amount, 2) !!}</span>
                                    <small class="text-muted">{!! __('general.sar') !!}</small>
                                </td>
                                <td class="py-2 text-muted small">{!! $cheque->due_date ? $cheque->due_date->format('Y-m-d') : '---' !!}</td>
                                <td class="py-2 text-center">
                                    <span
                                        class="badge badge-pill badge-light-{{ $cheque->status_color }} border-0 px-2 py-1 font-weight-bold shadow-none status-badge-min">
                                        <i class="fas fa-circle font-small-1 mr-25"></i>
                                        {!! $cheque->status_label !!}
                                    </span>
                                </td>
                                <td class="py-2">
                                    @if ($cheque->is_deposit)
                                        <span
                                            class="badge badge-light-warning badge-pill border-0 px-2 py-25 font-weight-bold">{!! __('cheques.insurance_cheques') !!}</span>
                                    @else
                                        <span
                                            class="badge badge-light-primary badge-pill border-0 px-2 py-25 font-weight-bold">{!! __('cheques.rent_cheques') !!}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center opacity-50">
                                        <i class="fas fa-money-check font-large-2 text-muted mb-2"></i>
                                        <span class="text-muted font-weight-bold">{!! __('general.no_data_found') !!}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
