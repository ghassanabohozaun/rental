<div class="tab-pane fade" id="payments" role="tabpanel">
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div
            class="card-header bg-white border-bottom py-2 px-3 d-flex {{ request()->ajax() ? 'justify-content-end' : 'justify-content-between' }} align-items-center">
            @if (!request()->ajax())
                <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                    <i class="fas fa-money-bill text-primary mr-1"></i>
                    <span>{!! __('payments.payments') !!}</span>
                </h6>
            @endif
            @if (!request()->ajax())
                @can('payments_create')
                    <a href="{!! route('dashboard.payments.create') !!}?contract_id={!! $contract->id !!}"
                        class="btn btn-sm btn-light-primary radius-10">
                        <i class="fas fa-plus-circle mr-1"></i>
                        <span>{!! __('payments.add_payment') !!}</span>
                    </a>
                @endcan
            @endif
        </div>
        <div class="card-body p-0">
            <div class="scrollable-table-container" style="max-height: 350px; overflow-y: auto; overflow-x: auto;">
                <table class="table table-hover mb-0">
                    <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                        <tr class="text-muted" style="font-size: 15px;">
                            <th class="border-top-0 py-2">#</th>
                            <th class="border-top-0 py-2">{!! __('general.date') !!}</th>
                            <th class="border-top-0 py-2">{!! __('payments.amount') !!}</th>
                            <th class="border-top-0 py-2">{!! __('payments.method') !!}</th>
                            <th class="border-top-0 py-2 text-center">{!! __('payments.payment_type') !!}</th>
                            <th class="border-top-0 py-2 text-center">{!! __('payments.status') !!}</th>
                            <th class="border-top-0 py-2" style="min-width: 150px;">{!! __('general.notes') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        @forelse($contract->payments->sortByDesc('payment_date') as $payment)
                            <tr>
                                <td class="py-2">#{!! $loop->iteration !!}</td>
                                <td class="py-2">{!! $payment->payment_date->format('Y-m-d') !!}</td>
                                <td class="py-2 font-weight-bold text-success">{!! number_format($payment->amount, 2) !!}</td>
                                <td class="py-2">
                                    <span
                                        class="badge badge-light-{{ $payment->method_color }} badge-pill border-0 px-2 py-1">
                                        <i class="fas fa-{{ $payment->method_icon }} mr-1"></i>
                                        {!! $payment->method_label !!}
                                    </span>
                                </td>
                                <td class="py-2 text-center">
                                    <span
                                        class="badge badge-light-{{ $payment->type_color }} badge-pill border-0 px-2 py-1">
                                        <i class="fas fa-file-invoice-dollar mr-1"></i>
                                        {!! $payment->type_label !!}
                                    </span>
                                </td>
                                <td class="py-2 text-center">
                                    <span
                                        class="badge badge-light-{{ $payment->status_color }} badge-pill border-0 px-2 py-1">
                                        <i class="fas fa-circle font-small-1 mr-1"></i>
                                        {!! $payment->status_label !!}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <span class="text-muted" style="font-size: 0.85rem;"
                                        title="{!! $payment->notes !!}">
                                        {!! \Illuminate\Support\Str::limit($payment->notes, 60, '...') ?? '---' !!}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i
                                        class="fas fa-money-bill-wave font-large-1 text-muted d-block mb-2 opacity-50"></i>
                                    <span class="text-muted">{!! __('general.no_data_found') !!}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
