<!-- Contracts Tab -->
<div class="tab-pane fade" id="contracts" role="tabpanel">
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom py-2 px-3">
            <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                <i class="fas fa-file-contract text-primary mr-1"></i>
                <span>{!! __('contracts.contracts') !!}</span>
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted" style="font-size: 14px;">
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">{!! __('properties.property') !!}</th>
                            <th class="border-top-0">{!! __('contracts.start_date') !!}</th>
                            <th class="border-top-0">{!! __('contracts.end_date') !!}</th>
                            <th class="border-top-0">{!! __('contracts.rent_amount') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.status') !!}</th>
                            <th class="border-top-0 text-center">{!! __('general.actions') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($customer->contracts as $contract)
                        <tr>
                            <td class="py-2">#{!! $contract->id !!}</td>
                            <td class="py-2">
                                <div class="font-weight-bold">{!! optional($contract->property)->name !!}</div>
                                <small class="text-muted">{!! optional($contract->property->type)->name !!}</small>
                            </td>
                            <td class="py-2">{!! $contract->start_date->format('Y-m-d') !!}</td>
                            <td class="py-2">{!! $contract->end_date->format('Y-m-d') !!}</td>
                            <td class="py-2 font-weight-bold text-success">{!! number_format($contract->rent_amount, 2) !!}</td>
                            <td class="py-2 text-center">
                                @php
                                    $cStatusColor = 'success';
                                    if($contract->status == 'ended') $cStatusColor = 'warning';
                                    if($contract->status == 'cancelled') $cStatusColor = 'danger';
                                @endphp
                                <span class="badge badge-light-{!! $cStatusColor !!} badge-pill border-0 px-2">
                                    {!! __('contracts.status_' . $contract->status) !!}
                                </span>
                            </td>
                            <td class="py-2 text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{!! route('dashboard.contracts.show', $contract->id) !!}" class="btn-premium-action btn-premium-action-info mr-1" title="{!! __('general.view') !!}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-success mr-1 btn-show-payments" data-id="{!! $contract->id !!}" title="{!! __('payments.payments') !!}">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-warning btn-show-cheques" data-id="{!! $contract->id !!}" title="{!! __('cheques.cheques') !!}">
                                        <i class="fas fa-money-check-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                {!! __('general.no_data_found') !!}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
